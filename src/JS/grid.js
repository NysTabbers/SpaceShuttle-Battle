const grid = document.getElementById('grid');
const detailsTitle = document.getElementById('details-title');
const detailsContent = document.getElementById('details-content');
const confirmBtn = document.getElementById('confirm-selection');
const shipDetails = document.getElementById('ship-details');
const modalBackdrop = document.getElementById('modal-backdrop');
const closeModalBtn = document.getElementById('close-modal');

let ships = [];
let selected = null;

// Show modal
function showModal() {
  shipDetails.classList.add('active');
  modalBackdrop.classList.add('active');
}

// Hide modal
function hideModal() {
  shipDetails.classList.remove('active');
  modalBackdrop.classList.remove('active');
}

// Close button listener
closeModalBtn.addEventListener('click', hideModal);

// Close modal when clicking backdrop
modalBackdrop.addEventListener('click', hideModal);

async function loadShips() {
    try {
        const res = await fetch('../PHP/ships.php');
        ships = await res.json();
    } catch (e) {
        console.error('Failed to load ships', e);
        ships = [];
    }
}

function renderGrid() {
    grid.innerHTML = '';
    const total = 20;
    for (let i = 1; i <= total; i++) {
        const img = document.createElement('img');
        img.src = `../../ASSETS/wallhaven-${i}.png`;
        img.alt = `wallpaper ${i}`;
        img.classList.add('thumb');
        const shipIndex = ships.length ? ((i - 1) % ships.length) : -1;
        img.dataset.shipIndex = shipIndex;
        img.dataset.imgIndex = i - 1;

        img.addEventListener('click', () => selectImage(img));

        grid.appendChild(img);
    }

    // restore previous selection
    const saved = localStorage.getItem('selectedShip');
    if (saved) {
        try {
            const obj = JSON.parse(saved);
            const selector = `.grid img[data-ship-index="${obj.shipIndex}"]`;
            const img = document.querySelector(selector);
            if (img) selectImage(img);
        } catch (e) { /* ignore */ }
    }
}

function selectImage(img) {
    document.querySelectorAll('.grid img.selected').forEach(i => i.classList.remove('selected'));
    img.classList.add('selected');

    const shipIndex = parseInt(img.dataset.shipIndex, 10);
    const imgIndex = parseInt(img.dataset.imgIndex, 10);
    selected = { shipIndex, imgIndex, imgSrc: img.src };

    if (shipIndex >= 0 && ships[shipIndex]) {
        const s = ships[shipIndex];
        detailsTitle.textContent = s.name;
        detailsContent.innerHTML = `
            <strong>HP:</strong> ${s.hp} &nbsp; <strong>Shield:</strong> ${s.shield} <br>
            <strong>Engine:</strong> ${s.engine ? s.engine.name + ' (speed ' + s.engine.speed + ')' : '—'}<br>
            <strong>Weapons:</strong> ${s.weapons.map(w => w.name + ' ('+w.attackDamage+')').join(', ')}
        `;
        confirmBtn.disabled = false;
    } else {
        detailsTitle.textContent = 'No ship assigned';
        detailsContent.textContent = 'This image is not mapped to a ship.';
        confirmBtn.disabled = true;
    }
    
    // Show the modal
    showModal();
}

confirmBtn.addEventListener('click', () => {
    if (!selected) return;
    localStorage.setItem('selectedShip', JSON.stringify(selected));

    // send selection to server so PHP can use it in `battle.php`
    fetch('../PHP/set_selection.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ shipIndex: selected.shipIndex, imgIndex: selected.imgIndex })
    }).then(r => r.json()).then(res => {
        if (res && res.success) {
            detailsContent.innerHTML += '<div style="margin-top:6px;color:#aefad8">Selected and saved (server). Redirecting to battle...</div>';
            // short delay so user sees confirmation, then go to index.php to watch the battle
            setTimeout(() => { window.location.href = 'index.php'; }, 700);
        } else {
            detailsContent.innerHTML += '<div style="margin-top:6px;color:#f3a6a6">Saved locally but failed to save server-side.</div>';
        }
    }).catch(() => {
        detailsContent.innerHTML += '<div style="margin-top:6px;color:#f3a6a6">Saved locally but failed to save server-side.</div>';
    });
});

(async function init() {
    await loadShips();
    renderGrid();
})();

