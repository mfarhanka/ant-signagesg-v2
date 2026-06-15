// Portfolio Filters
        function filterPortfolio(category) {
            const items = document.querySelectorAll('.portfolio-item');
            const buttons = document.querySelectorAll('.portfolio-filter-btn');

            buttons.forEach(btn => {
                if (btn.textContent.toLowerCase().includes(category) || (category === 'all' && btn.textContent.toLowerCase().includes('all'))) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });

            items.forEach(item => {
                if (category === 'all' || item.getAttribute('data-category') === category) {
                    item.style.display = 'block';
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'scale(1)';
                    }, 50);
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        }

        // B2B SGD Signage Estimator Mathematics
        function runCostEstimate() {
            const category = document.getElementById('est-category').value;
            const width = parseFloat(document.getElementById('est-width').value) || 0;
            const height = parseFloat(document.getElementById('est-height').value) || 0;
            const mount = document.getElementById('est-mount').value;
            const install = document.getElementById('est-install').value;

            // Compute Area in Square Meters
            const area = width * height;

            if (area <= 0) {
                document.getElementById('price-display').innerText = 'S$0';
                return;
            }

            // Real-world production rates per square meter in Singapore
            let baseRate = 0;
            switch(category) {
                case 'led':
                    baseRate = 1100; // Premium waterproof halo/front lit 3D lettering
                    break;
                case 'corporate-acrylic':
                    baseRate = 500;  // High polish non-lit raised letters
                    break;
                case 'metal-stainless':
                    baseRate = 800;  // Marine grade brushed/titanium steel
                    break;
                case 'large-vinyl':
                    baseRate = 220;  // Highly durable UV stable vinyl stickers
                    break;
                case 'frosting-glass':
                    baseRate = 110;  // High precision plotter glass frosting
                    break;
            }

            // Material fabrication sub-total
            let subtotal = area * baseRate;

            // Mounting and engineering coefficients
            let mountingMultiplier = 1.0;
            switch(mount) {
                case 'glass':
                    mountingMultiplier = 1.15; // Double-sided aligner plates
                    break;
                case 'external-high':
                    mountingMultiplier = 1.65; // High altitude scaffold / skylift setup
                    break;
                case 'external-low':
                    mountingMultiplier = 1.30; // Ground entrance structural framing
                    break;
            }

            subtotal *= mountingMultiplier;

            // Flat rate installation service costs
            let installFee = 0;
            if (install === 'yes') {
                if (category === 'led' || mount === 'external-high') {
                    installFee = 550; // Certified electricians + high-elevation crews
                } else {
                    installFee = 220; // Standard layout technicians
                }
            }

            const totalEstimate = Math.round(subtotal + installFee);

            // Bounds matrix (+/- 12%)
            const lowerBound = Math.round(totalEstimate * 0.88);
            const upperBound = Math.round(totalEstimate * 1.12);

            // Localization
            const formattedMin = new Intl.NumberFormat('en-SG', { style: 'currency', currency: 'SGD', maximumFractionDigits: 0 }).format(lowerBound);
            const formattedMax = new Intl.NumberFormat('en-SG', { style: 'currency', currency: 'SGD', maximumFractionDigits: 0 }).format(upperBound);

            document.getElementById('price-display').innerText = `${formattedMin} - ${formattedMax}`;

            // BCA Structural Submission check indicators
            const bcaDetailSpan = document.getElementById('detail-bca');
            if (height > 2.0 || mount === 'external-high') {
                bcaDetailSpan.innerText = 'BCA Permit Required';
                bcaDetailSpan.style.color = '#ff4d4d'; // Soft red highlight
            } else {
                bcaDetailSpan.innerText = 'Self-Certified Safe';
                bcaDetailSpan.style.color = '#00e676'; // Light green
            }
        }

        // Seamless prepopulation of values to contact form
        function prepopulateQuoteForm() {
            const categoryVal = document.getElementById('est-category').value;
            const wVal = document.getElementById('est-width').value;
            const hVal = document.getElementById('est-height').value;
            
            let targetScope = 'others';
            if (categoryVal === 'led') targetScope = '3d-led';
            if (categoryVal === 'corporate-acrylic' || categoryVal === 'metal-stainless') targetScope = 'lobby-brand';
            if (categoryVal === 'frosting-glass') targetScope = 'frosting';

            document.getElementById('q-scope').value = targetScope;
            document.getElementById('q-notes').value = `Auto-imported configuration from cost calculator:\n• Class Type: ${categoryVal}\n• Sizing: ${wVal}m Width x ${hVal}m Height\n\nPlease verify these parameters and schedule a physical site survey measurement.`;
        }

        // Clean RFQ Form submission handling
        function handleFormSubmission(event) {
            event.preventDefault();

            const randomID = Math.floor(10000 + Math.random() * 90000);
            document.getElementById('ref-id').innerText = `APX-${randomID}`;

            document.getElementById('rfq-form').style.display = 'none';
            document.getElementById('success-message').style.display = 'block';
        }

        function resetForm() {
            document.getElementById('rfq-form').reset();
            document.getElementById('rfq-form').style.display = 'block';
            document.getElementById('success-message').style.display = 'none';
        }

        function initReviewsCarousel() {
            const carousel = document.getElementById('reviewsCarousel');
            if (!carousel) {
                return;
            }

            const track = carousel.querySelector('.reviews-carousel-track');
            const items = Array.from(carousel.querySelectorAll('.reviews-carousel-item'));
            const prevButton = carousel.querySelector('[data-review-prev]');
            const nextButton = carousel.querySelector('[data-review-next]');
            const dotsContainer = carousel.querySelector('[data-review-dots]');
            let currentIndex = 0;
            let maxIndex = 0;
            let autoplayId;

            function getVisibleCount() {
                return 3;
            }

            function buildDots() {
                dotsContainer.innerHTML = '';
                for (let index = 0; index <= maxIndex; index += 1) {
                    const dot = document.createElement('button');
                    dot.type = 'button';
                    dot.className = 'reviews-carousel-dot';
                    dot.setAttribute('aria-label', `Go to review page ${index + 1}`);
                    dot.addEventListener('click', () => {
                        currentIndex = index;
                        updateCarousel();
                        restartAutoplay();
                    });
                    dotsContainer.appendChild(dot);
                }
            }

            function updateCarousel() {
                maxIndex = Math.max(items.length - getVisibleCount(), 0);
                if (currentIndex > maxIndex) {
                    currentIndex = maxIndex;
                }

                const itemWidth = items[0].getBoundingClientRect().width;
                const gap = 24;
                const offset = currentIndex * (itemWidth + gap);
                track.style.transform = `translateX(-${offset}px)`;

                if (dotsContainer.children.length !== maxIndex + 1) {
                    buildDots();
                }

                Array.from(dotsContainer.children).forEach((dot, index) => {
                    dot.classList.toggle('is-active', index === currentIndex);
                });

                prevButton.disabled = currentIndex === 0;
                nextButton.disabled = currentIndex === maxIndex;
            }

            function goNext() {
                currentIndex = currentIndex >= maxIndex ? 0 : currentIndex + 1;
                updateCarousel();
            }

            function goPrev() {
                currentIndex = currentIndex <= 0 ? maxIndex : currentIndex - 1;
                updateCarousel();
            }

            function startAutoplay() {
                autoplayId = window.setInterval(goNext, 4500);
            }

            function restartAutoplay() {
                window.clearInterval(autoplayId);
                startAutoplay();
            }

            prevButton.addEventListener('click', () => {
                goPrev();
                restartAutoplay();
            });

            nextButton.addEventListener('click', () => {
                goNext();
                restartAutoplay();
            });

            carousel.addEventListener('mouseenter', () => window.clearInterval(autoplayId));
            carousel.addEventListener('mouseleave', startAutoplay);
            window.addEventListener('resize', updateCarousel);

            buildDots();
            updateCarousel();
            startAutoplay();
        }

        function initTrustedBrandsCarousel() {
            const carousel = document.getElementById('trustedBrandsCarousel');
            if (!carousel) {
                return;
            }

            const track = carousel.querySelector('.trusted-brands-track');
            const items = Array.from(carousel.querySelectorAll('.trusted-brands-item'));
            const dotsContainer = carousel.querySelector('[data-brand-dots]');
            let currentIndex = 0;
            let maxIndex = 0;
            let autoplayId;

            if (!track || !items.length || !dotsContainer) {
                return;
            }

            function getVisibleCount() {
                if (window.innerWidth <= 575.98) {
                    return 2;
                }
                if (window.innerWidth <= 991.98) {
                    return 3;
                }
                return 5;
            }

            function buildDots() {
                dotsContainer.innerHTML = '';
                for (let index = 0; index <= maxIndex; index += 1) {
                    const dot = document.createElement('button');
                    dot.type = 'button';
                    dot.className = 'trusted-brands-dot';
                    dot.setAttribute('aria-label', `Go to trusted brand page ${index + 1}`);
                    dot.addEventListener('click', () => {
                        currentIndex = index;
                        updateCarousel();
                        restartAutoplay();
                    });
                    dotsContainer.appendChild(dot);
                }
            }

            function updateCarousel() {
                maxIndex = Math.max(items.length - getVisibleCount(), 0);
                if (currentIndex > maxIndex) {
                    currentIndex = maxIndex;
                }

                const itemWidth = items[0].getBoundingClientRect().width;
                const gap = 20;
                const offset = currentIndex * (itemWidth + gap);
                track.style.transform = `translateX(-${offset}px)`;

                if (dotsContainer.children.length !== maxIndex + 1) {
                    buildDots();
                }

                Array.from(dotsContainer.children).forEach((dot, index) => {
                    dot.classList.toggle('is-active', index === currentIndex);
                });
            }

            function goNext() {
                currentIndex = currentIndex >= maxIndex ? 0 : currentIndex + 1;
                updateCarousel();
            }

            function startAutoplay() {
                autoplayId = window.setInterval(goNext, 3200);
            }

            function restartAutoplay() {
                window.clearInterval(autoplayId);
                startAutoplay();
            }

            carousel.addEventListener('mouseenter', () => window.clearInterval(autoplayId));
            carousel.addEventListener('mouseleave', startAutoplay);
            window.addEventListener('resize', updateCarousel);

            buildDots();
            updateCarousel();
            startAutoplay();
        }

        function initHeroTitleRotation() {
            const rotatingWord = document.querySelector('[data-hero-rotate]');
            if (!rotatingWord) {
                return;
            }

            const phrases = [
                'Architects trust',
                'Developers rely on',
                'Property Owners are proud to display'
            ];
            let currentIndex = 0;

            window.setInterval(() => {
                rotatingWord.classList.add('is-changing');

                window.setTimeout(() => {
                    currentIndex = (currentIndex + 1) % phrases.length;
                    rotatingWord.textContent = phrases[currentIndex];
                    rotatingWord.classList.remove('is-changing');
                }, 220);
            }, 2600);
        }

        // Initialize on layout completion
        window.onload = function() {
            runCostEstimate();
            initReviewsCarousel();
            initTrustedBrandsCarousel();
            initHeroTitleRotation();
        };
