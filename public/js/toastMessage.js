function toast({ type = 'info', title = '', message = '', duration = 4000 }) {
    const main = document.getElementById('toast__container');
    if (main) {
        const toastContainer = document.createElement('div');
        const toastTimer = document.createElement('div');
        // Auto remove toast
        const autoRemoveId = setTimeout(() => {
            main.removeChild(toastContainer);
        }, duration + 1000);

        // Remove toast when clicked
        toastContainer.onclick = function (e) {
            if (e.target.closest('.toast__close')) {
                main.removeChild(toastContainer);
                clearTimeout(autoRemoveId);
            }
        };

        const icons = {
            success: 'fas fa-check-circle',
            info: 'fas fa-info-circle',
            warning: 'fas fa-exclamation-circle',
            error: 'fas fa-exclamation-circle',
        };

        const icon = icons[type];
        const deplay = (duration / 1000).toFixed(2);

        toastTimer.classList.add('toast__timer');
        toastContainer.classList.add('toast__content', `toast--${type}`);
        toastContainer.style.animation = `slideInLeft ease .3s, faceOut .25s ${deplay}s forwards`;
        toastTimer.style.animation = `reverseTimer ${deplay}s forwards`

        toastContainer.innerHTML = `
        <div class="toast__icon">
            <i class="${icon}"></i>
        </div>
        <div class="toast__body">
            <h3 class="toast__title">${title}</h3>
            <p class="toast__msg">${message}</p>
        </div>
        <div class="toast__close">
            <i class="fas fa-times"></i>
        </div>
        `;
        toastContainer.appendChild(toastTimer)
        main.appendChild(toastContainer);
    }
}
