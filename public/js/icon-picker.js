// Popular Font Awesome icons
const fontAwesomeIcons = [
    'fa fa-users', 'fa fa-book', 'fa fa-trophy', 'fa fa-briefcase', 'fa fa-graduation-cap',
    'fa fa-certificate', 'fa fa-laptop', 'fa fa-clock-o', 'fa fa-support', 'fa fa-star',
    'fa fa-heart', 'fa fa-check-circle', 'fa fa-check', 'fa fa-times', 'fa fa-plus',
    'fa fa-minus', 'fa fa-home', 'fa fa-envelope', 'fa fa-phone', 'fa fa-map-marker',
    'fa fa-globe', 'fa fa-facebook', 'fa fa-twitter', 'fa fa-instagram', 'fa fa-youtube',
    'fa fa-linkedin', 'fa fa-user', 'fa fa-user-circle', 'fa fa-user-md', 'fa fa-chart-line',
    'fa fa-chart-bar', 'fa fa-calendar', 'fa fa-clock', 'fa fa-cog', 'fa fa-cogs',
    'fa fa-search', 'fa fa-filter', 'fa fa-list', 'fa fa-bars', 'fa fa-arrow-up',
    'fa fa-arrow-down', 'fa fa-arrow-left', 'fa fa-arrow-right', 'fa fa-chevron-up',
    'fa fa-chevron-down', 'fa fa-chevron-left', 'fa fa-chevron-right', 'fa fa-play',
    'fa fa-pause', 'fa fa-download', 'fa fa-upload', 'fa fa-file', 'fa fa-folder',
    'fa fa-trash', 'fa fa-edit', 'fa fa-pencil', 'fa fa-save', 'fa fa-print',
    'fa fa-share', 'fa fa-link', 'fa fa-copy', 'fa fa-refresh', 'fa fa-spinner',
    'fa fa-info', 'fa fa-question', 'fa fa-exclamation', 'fa fa-warning', 'fa fa-lock',
    'fa fa-unlock', 'fa fa-key', 'fa fa-shield', 'fa fa-eye', 'fa fa-camera',
    'fa fa-image', 'fa fa-video-camera', 'fa fa-music', 'fa fa-bell', 'fa fa-comment',
    'fa fa-thumbs-up', 'fa fa-thumbs-down', 'fa fa-flag', 'fa fa-bookmark', 'fa fa-tag',
    'fa fa-gift', 'fa fa-car', 'fa fa-plane', 'fa fa-ship', 'fa fa-bicycle',
    'fa fa-gamepad', 'fa fa-fire', 'fa fa-sun', 'fa fa-moon', 'fa fa-cloud',
    'fa fa-tree', 'fa fa-leaf', 'fa fa-apple', 'fa fa-medal', 'fa fa-award',
    'fa fa-crown', 'fa fa-gem', 'fa fa-money-bill', 'fa fa-credit-card', 'fa fa-building',
    'fa fa-hospital', 'fa fa-school', 'fa fa-shopping-cart', 'fa fa-truck', 'fa fa-warehouse',
    'fa fa-lightbulb', 'fa fa-plug', 'fa fa-wifi', 'fa fa-server', 'fa fa-database',
    'fa fa-keyboard', 'fa fa-mouse', 'fa fa-printer', 'fa fa-calculator', 'fa fa-clock'
];

// Initialize icon picker
function initIconPicker() {
    const iconPickerGrids = document.querySelectorAll('#iconPickerGrid');
    iconPickerGrids.forEach(grid => {
        if (grid && grid.children.length === 0) {
            fontAwesomeIcons.forEach(iconClass => {
                const iconName = iconClass.replace('fa fa-', '');
                const item = document.createElement('div');
                item.className = 'icon-picker-item';
                item.innerHTML = `
                    <i class="${iconClass}"></i>
                    <span>${iconName}</span>
                `;
                item.onclick = function() {
                    const container = grid.closest('.icon-picker-container');
                    const formGroup = container ? container.closest('.form-group') : null;
                    if (formGroup) {
                        const input = formGroup.querySelector('.icon-input');
                        const preview = formGroup.querySelector('.icon-preview-display');
                        if (input) {
                            input.value = iconClass;
                            if (preview) {
                                preview.innerHTML = `<i class="${iconClass}"></i>`;
                            }
                        }
                    }
                    // Close dropdown
                    const dropdown = grid.closest('.icon-picker-dropdown');
                    if (dropdown) {
                        dropdown.classList.remove('show');
                    }
                };
                grid.appendChild(item);
            });
        }
    });
}

// Toggle icon picker
function toggleIconPicker(btn) {
    const formGroup = btn.closest('.form-group');
    const dropdown = formGroup ? formGroup.querySelector('.icon-picker-dropdown') : null;
    if (dropdown) {
        dropdown.classList.toggle('show');
        if (dropdown.classList.contains('show')) {
            initIconPicker();
        }
    }
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', function() {
    // Close icon picker when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.icon-picker-container') && !e.target.closest('.icon-preview-btn')) {
            document.querySelectorAll('.icon-picker-dropdown').forEach(dropdown => {
                dropdown.classList.remove('show');
            });
        }
    });

    // Update preview when icon input changes
    document.querySelectorAll('.icon-input').forEach(input => {
        input.addEventListener('input', function() {
            const formGroup = this.closest('.form-group');
            const preview = formGroup ? formGroup.querySelector('.icon-preview-display') : null;
            if (preview && this.value) {
                preview.innerHTML = `<i class="${this.value}"></i>`;
            } else if (preview) {
                preview.innerHTML = '';
            }
        });
        
        // Show preview if value exists on load
        if (input.value) {
            const formGroup = input.closest('.form-group');
            const preview = formGroup ? formGroup.querySelector('.icon-preview-display') : null;
            if (preview) {
                preview.innerHTML = `<i class="${input.value}"></i>`;
            }
        }
    });
});

