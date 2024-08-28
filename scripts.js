$(document).ready(function() {
    // Function to check if an element is in view
    function isElementInView(element) {
        var elementTop = $(element).offset().top;
        var elementBottom = elementTop + $(element).outerHeight();

        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();

        return elementBottom > viewportTop && elementTop < viewportBottom;
    }

    // Function to add fade-in animation
    function checkAnimation() {
        $('.azman-6').each(function() {
            if (isElementInView(this)) {
                $(this).addClass('fade-in');
            }
        });
    }

    $(window).on('scroll resize', checkAnimation);
    $(window).trigger('scroll');

    // Handling testimonial form submission
    const form = document.getElementById('testimonialForm');
    const testimonialsContainer = document.getElementById('testimonials');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const testimonial = document.getElementById('testimonial').value;
        const photo = document.getElementById('photo').files[0];

        if (photo) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const photoSrc = e.target.result;

                const testimonialCard = document.createElement('div');
                testimonialCard.className = 'col-md-4';
                testimonialCard.innerHTML = `
                    <div class="card" style="width: 18rem;">
                        <img src="${photoSrc}" class="card-img-top" alt="Customer photo">
                        <div class="card-body">
                            <h5 class="card-title">${name}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">${email}</h6>
                            <p class="card-text">${testimonial}</p>
                        </div>
                    </div>
                `;
                testimonialsContainer.appendChild(testimonialCard);
            };
            reader.readAsDataURL(photo);
        }

        form.reset();
    });

    // Handling payment form submission
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
        var metodePembayaran = document.querySelector('input[name="metode_pembayaran"]:checked').value;
        if (metodePembayaran === 'brimo') {
            window.location.href = 'brimo://open';
        } else if (metodePembayaran === 'wealet') {
            window.location.href = 'dana://open';
        } else if (metodePembayaran === 'cash') {
            // Tambahkan tindakan yang sesuai untuk pembayaran tunai di sini
            alert('Silakan hubungi kami untuk pembayaran tunai.');
        }

        event.preventDefault(); // Menghentikan pengiriman formulir
    });
});
