document.addEventListener('DOMContentLoaded', () => {
    // Select images inside article content. 
    // Excluding images that are explicitly set to not zoom, or avatars, etc.
    const images = document.querySelectorAll('.prose img, .paijo-prose img');
    if (images.length === 0) return;

    // Create lightbox DOM elements
    const overlay = document.createElement('div');
    overlay.className = 'paijo-lightbox-overlay';
    
    const overlayImg = document.createElement('img');
    
    const closeBtn = document.createElement('div');
    closeBtn.className = 'paijo-lightbox-close';
    closeBtn.innerHTML = '&times;'; // Close icon
    
    overlay.appendChild(overlayImg);
    overlay.appendChild(closeBtn);
    document.body.appendChild(overlay);

    // Function to close lightbox
    function closeLightbox() {
        overlay.classList.remove('active');
        setTimeout(() => {
            overlayImg.src = '';
        }, 300); // Wait for fade out transition
    }

    // Close when clicking outside the image
    overlay.addEventListener('click', (e) => {
        if (e.target !== overlayImg) {
            closeLightbox();
        }
    });

    // Close when clicking the image itself
    overlayImg.addEventListener('click', () => {
        closeLightbox();
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && overlay.classList.contains('active')) {
            closeLightbox();
        }
    });

    // Attach click event to all article images
    images.forEach(img => {
        // Check if image is portrait to apply correct aspect ratio CSS
        const applyPortraitClass = () => {
            if (img.naturalHeight > img.naturalWidth) {
                img.classList.add('paijo-portrait');
            }
        };

        if (img.complete) {
            applyPortraitClass();
        } else {
            img.addEventListener('load', applyPortraitClass);
        }

        img.addEventListener('click', (e) => {
            e.preventDefault();
            
            // Determine the full size image URL
            let fullSizeUrl = img.src;
            
            // Check if the image is wrapped in a link to a full-size image (WordPress default behavior often does this)
            const parent = img.closest('a');
            if (parent && parent.href.match(/\.(jpg|jpeg|png|gif|webp)$/i)) {
                fullSizeUrl = parent.href;
            } else if (img.dataset.large_image) {
                fullSizeUrl = img.dataset.large_image;
            }
            
            // Show lightbox
            overlayImg.src = fullSizeUrl;
            overlay.classList.add('active');
        });
    });
});
