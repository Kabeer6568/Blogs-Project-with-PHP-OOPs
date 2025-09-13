// Mobile Navigation Toggle
document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');

    if (hamburger && navMenu) {
        hamburger.addEventListener('click', function() {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.nav-menu li a').forEach(n => n.addEventListener('click', () => {
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
        }));
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Form validation and enhancement
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
    form.addEventListener('submit', function(e) {
        const submitBtn = form.querySelector('input[type="submit"], button[type="submit"]');
        if (submitBtn) {
            const isInput = submitBtn.tagName.toLowerCase() === 'input';
            const originalText = isInput ? submitBtn.value : submitBtn.innerHTML;

            submitBtn.disabled = true;
            if (isInput) {
                submitBtn.value = 'Processing...';
            } else {
                submitBtn.innerHTML = '<span class="loading"></span> Processing...';
            }

            // Safety reset after 3 seconds (optional)
            setTimeout(() => {
                submitBtn.disabled = false;
                if (isInput) {
                    submitBtn.value = originalText;
                } else {
                    submitBtn.innerHTML = originalText;
                }
            }, 3000);
        }
    });
});


        // Real-time form validation
        // const inputs = form.querySelectorAll('input, textarea, select');
        // inputs.forEach(input => {
        //     // Add focus/blur effects
        //     input.addEventListener('focus', function() {
        //         this.parentElement.classList.add('focused');
        //     });

        //     input.addEventListener('blur', function() {
        //         this.parentElement.classList.remove('focused');
        //         if (this.value.trim() === '') {
        //             this.classList.add('error');
        //         } else {
        //             this.classList.remove('error');
        //         }
        //     });

        //     // Email validation
        //     if (input.type === 'email') {
        //         input.addEventListener('input', function() {
        //             const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        //             if (this.value && !emailRegex.test(this.value)) {
        //                 this.classList.add('error');
        //             } else {
        //                 this.classList.remove('error');
        //             }
        //         });
        //     }

        //     // Password strength indicator
        //     if (input.type === 'password' && input.name.includes('pass')) {
        //         input.addEventListener('input', function() {
        //             const strength = checkPasswordStrength(this.value);
        //             updatePasswordStrengthIndicator(this, strength);
        //         });
        //     }
        // });
    });

    // File upload preview
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    showImagePreview(input, e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    });

    // Status dropdown enhancement
    const statusSelects = document.querySelectorAll('select[name="status"]');
    statusSelects.forEach(select => {
        select.addEventListener('change', function() {
            const option = this.options[this.selectedIndex];
            this.className = 'status-badge status-' + option.value;
        });
        
        // Set initial class
        const initialValue = select.value;
        select.className = 'status-badge status-' + initialValue;
    });

    // Table enhancements
    const tables = document.querySelectorAll('table');
    tables.forEach(table => {
        // Add hover effects to rows
        const rows = table.querySelectorAll('tbody tr');
        rows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = 'rgba(102, 126, 234, 0.05)';
            });
            row.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '';
            });
        });

        // Make table responsive
        const container = table.parentElement;
        if (!container.classList.contains('table-container')) {
            const wrapper = document.createElement('div');
            wrapper.className = 'table-container';
            table.parentNode.insertBefore(wrapper, table);
            wrapper.appendChild(table);
        }
    });

    // Animated counter for dashboard stats
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target')) || parseInt(counter.textContent);
        const duration = 2000; // 2 seconds
        const step = target / (duration / 16); // 60fps
        let current = 0;
        
        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                counter.textContent = target;
                clearInterval(timer);
            } else {
                counter.textContent = Math.floor(current);
            }
        }, 16);
    });

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                alert.remove();
            }, 300);
        }, 5000);
    });

    // Confirm before delete actions
    const deleteLinks = document.querySelectorAll('a[href*="delete"], button[onclick*="delete"]');
    deleteLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
                e.preventDefault();
                return false;
            }
        });
    });

    // Search functionality (if search input exists)
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const searchableItems = document.querySelectorAll('.searchable');
            
            searchableItems.forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
;

// Utility Functions
function checkPasswordStrength(password) {
    let strength = 0;
    if (password.length >= 8) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;
    return strength;
}

function updatePasswordStrengthIndicator(input, strength) {
    let existingIndicator = input.parentElement.querySelector('.password-strength');
    if (!existingIndicator) {
        existingIndicator = document.createElement('div');
        existingIndicator.className = 'password-strength';
        input.parentElement.appendChild(existingIndicator);
    }
    
    const strengthTexts = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
    const strengthClasses = ['very-weak', 'weak', 'fair', 'good', 'strong'];
    
    existingIndicator.textContent = strengthTexts[strength - 1] || 'Very Weak';
    existingIndicator.className = 'password-strength ' + (strengthClasses[strength - 1] || 'very-weak');
}

function showImagePreview(input, imageSrc) {
    let preview = input.parentElement.querySelector('.image-preview');
    if (!preview) {
        preview = document.createElement('div');
        preview.className = 'image-preview';
        input.parentElement.appendChild(preview);
    }
    
    preview.innerHTML = `
        <img src="${imageSrc}" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 10px; margin-top: 10px;">
        <button type="button" class="remove-preview" onclick="this.parentElement.remove()">×</button>
    `;
}

// Smooth page transitions
function smoothPageTransition() {
    document.body.style.opacity = '0';
    setTimeout(() => {
        document.body.style.opacity = '1';
    }, 100);
}

// Initialize page
window.addEventListener('load', smoothPageTransition);

// Add CSS for password strength indicator
const style = document.createElement('style');
style.textContent = `
    .password-strength {
        margin-top: 5px;
        font-size: 12px;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 4px;
        display: inline-block;
    }
    .password-strength.very-weak { background: #ffebee; color: #c62828; }
    .password-strength.weak { background: #fff3e0; color: #ef6c00; }
    .password-strength.fair { background: #fff8e1; color: #f57f17; }
    .password-strength.good { background: #e8f5e8; color: #2e7d32; }
    .password-strength.strong { background: #e3f2fd; color: #1565c0; }
    
    .image-preview {
        position: relative;
        display: inline-block;
    }
    .remove-preview {
        position: absolute;
        top: 5px;
        right: 5px;
        background: #dc3545;
        color: white;
        border: none;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 16px;
        line-height: 1;
    }
    
    input.error {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1) !important;
    }
`;
document.head.appendChild(style);