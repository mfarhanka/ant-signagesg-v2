<?php
$pageTitle = 'Signage SG | Premium Architectural Fabricators Singapore';
$navPage = 'home';
$metaDescription = 'Signage SG delivers commercial signage fabrication and installation in Singapore, from 3D lettering and acrylic signs to lightboxes, decals, and site-ready project coordination.';
$siteBaseUrl = 'https://signages.com.sg';
$canonicalPath = '/';
$ogImage = 'assets/images/logo.png';
$structuredData = [
    '@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    'name' => 'Signage SG',
    'description' => $metaDescription,
    'url' => $siteBaseUrl . '/',
    'logo' => $siteBaseUrl . '/assets/images/logo.png',
    'image' => $siteBaseUrl . '/assets/images/logo.png',
    'telephone' => '+65 8286 1600',
    'email' => 'antadv.gan@gmail.com',
    'priceRange' => '$$',
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => '601 Ang Mo Kio Avenue 5',
        'addressLocality' => 'Singapore',
        'postalCode' => '560601',
        'addressCountry' => 'SG'
    ],
    'openingHoursSpecification' => [[
        '@type' => 'OpeningHoursSpecification',
        'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
        'opens' => '09:00',
        'closes' => '18:00'
    ]],
    'areaServed' => [
        '@type' => 'Country',
        'name' => 'Singapore'
    ],
    'sameAs' => [
        'https://wa.me/6582861600'
    ],
    'makesOffer' => [
        ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => '3D signage fabrication']],
        ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Acrylic signage installation']],
        ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Lightbox signage production']],
        ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Vinyl decal and sticker installation']]
    ]
];
require __DIR__ . '/includes/header.php';
?>

    <header id="hero" class="hero-section">
        <div class="hero-grid"></div>
        <div class="hero-diagonal-accent"></div>
        
        <div class="container relative z-3">
            <div class="row align-items-center justify-content-between g-5">
                <div class="col-lg-7 text-start">
                    <div class="d-inline-flex align-items-center gap-2 border border-technical px-3 py-1.5 mb-4" style="background: var(--color-light-gray);">
                        <span class="d-inline-block bg-black rounded-circle" style="width: 8px; height: 8px;"></span>
                        <span class="text-uppercase tracking-wider text-black fw-bold" style="font-size: 0.7rem; letter-spacing: 2px;">Singapore Registered Sign Contractor</span>
                    </div>
                    
                    <h1 class="display-3 text-black mb-4 tracking-tight lh-sm hero-title">
                        <span class="d-block">WE DESIGN AND BUILD SIGNAGE</span>
                        <span class="hero-rotating-line">
                            <span class="hero-rotating-prefix">that</span>
                            <span class="hero-rotating-word" data-hero-rotate>Architects trust</span>
                        </span>
                    </h1>
                    
                    <p class="lead text-dark-gray mb-5 max-w-lg hero-subcopy" style="font-weight: 400; line-height: 1.8; font-size: 1.1rem;">
                        Built for teams that need signage done right. Architects trust it, developers rely on it, and property owners are proud to display it.
                    </p>
                    
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#estimator" class="btn-wb-solid">Calculate Signage Cost</a>
                    </div>
                </div>

                <div class="col-lg-5 d-none d-lg-block">
                    <!-- Technical CAD Outline Signage Display -->
                    <div class="p-4 border-technical" style="background: var(--color-pure-white);">
                        <div class="d-flex justify-content-between align-items-center border-bottom border-technical pb-3 mb-3">
                            <span class="text-uppercase tracking-wider text-black font-monospace fw-bold" style="font-size: 0.7rem;">CAD FILE REVISION // SG-2026-X</span>
                            <span class="badge bg-black text-white px-2 py-1 font-monospace" style="font-size: 0.65rem; border-radius: 0px;">APPROVED</span>
                        </div>
                        
                        <!-- Mini structural blueprint SVG wireframe -->
                        <svg viewBox="0 0 400 300" class="w-full" style="border: 1px dashed rgba(0,0,0,0.2);">
                            <!-- Grid Layout -->
                            <line x1="50" y1="0" x2="50" y2="300" stroke="rgba(0,0,0,0.05)" />
                            <line x1="150" y1="0" x2="150" y2="300" stroke="rgba(0,0,0,0.05)" />
                            <line x1="250" y1="0" x2="250" y2="300" stroke="rgba(0,0,0,0.05)" />
                            <line x1="350" y1="0" x2="350" y2="300" stroke="rgba(0,0,0,0.05)" />
                            <line x1="0" y1="75" x2="400" y2="75" stroke="rgba(0,0,0,0.05)" />
                            <line x1="0" y1="150" x2="400" y2="150" stroke="rgba(0,0,0,0.05)" />
                            <line x1="0" y1="225" x2="400" y2="225" stroke="rgba(0,0,0,0.05)" />

                            <!-- Dimension Box -->
                            <rect x="70" y="70" width="260" height="160" fill="none" stroke="black" stroke-width="2"/>
                            
                            <!-- Laser projection vector markers -->
                            <line x1="70" y1="50" x2="330" y2="50" stroke="black" stroke-width="1" stroke-dasharray="3,3"/>
                            <path d="M70 45V55M330 45V55" stroke="black" stroke-width="1"/>
                            <text x="200" y="40" fill="black" font-family="monospace" font-weight="bold" font-size="11" text-anchor="middle">3000 mm (W)</text>

                            <line x1="350" y1="70" x2="350" y2="230" stroke="black" stroke-width="1" stroke-dasharray="3,3"/>
                            <path d="M345 70H355M345 230H355" stroke="black" stroke-width="1"/>
                            <text x="375" y="155" fill="black" font-family="monospace" font-weight="bold" font-size="11" text-anchor="middle" transform="rotate(90 375 155)">1800 mm (H)</text>
                            
                            <!-- 3D Halo LED Layer Demonstration -->
                            <path d="M120 180 L160 100 L200 180" fill="none" stroke="black" stroke-width="4"/>
                            <path d="M117 183 L157 103 L197 183" fill="none" stroke="rgba(0,0,0,0.2)" stroke-width="4"/>
                            <line x1="140" y1="150" x2="180" y2="150" stroke="black" stroke-width="3"/>
                            
                            <!-- Core description -->
                            <text x="200" y="270" fill="black" font-family="monospace" font-weight="bold" font-size="10" text-anchor="middle">3D HALO-LIT CHROME STAINLESS STEEL LETTERING</text>
                        </svg>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3 text-dark-gray font-monospace" style="font-size: 0.75rem;">
                            <span>SCALE: 1:12</span>
                            <span>CNC PRECISION FORMING</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow-1">

    <section id="video-showcase" class="video-showcase-section py-5 border-bottom border-technical">
        <div class="container py-4 py-lg-5">
            <div class="row align-items-end justify-content-between g-4 mb-4 mb-lg-5">
                <div class="col-lg-7">
                    <h2 class="display-5 text-black mt-2 mb-3">Our Signage Work In Motion</h2>
                </div>
            </div>

            <div class="video-showcase-grid">
                <article class="video-showcase-card">
                    <video class="video-showcase-media" autoplay muted loop playsinline preload="metadata">
                        <source src="assets/videos/signage-showcase-01.mp4" type="video/mp4">
                    </video>
                </article>
                <article class="video-showcase-card">
                    <video class="video-showcase-media" autoplay muted loop playsinline preload="metadata">
                        <source src="assets/videos/signage-showcase-02.mp4" type="video/mp4">
                    </video>
                </article>
                <article class="video-showcase-card">
                    <video class="video-showcase-media" autoplay muted loop playsinline preload="metadata">
                        <source src="assets/videos/signage-showcase-03.mp4" type="video/mp4">
                    </video>
                </article>
                <article class="video-showcase-card">
                    <video class="video-showcase-media" autoplay muted loop playsinline preload="metadata">
                        <source src="assets/videos/signage-showcase-04.mp4" type="video/mp4">
                    </video>
                </article>
            </div>
        </div>
    </section>

    <section id="trusted-brands" class="trusted-brands-section border-bottom border-technical">
        <div class="container py-5">
            <div class="row align-items-end justify-content-between g-4 mb-4 mb-lg-5">
                <div class="col-lg-7">
                    <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.78rem; letter-spacing: 2px;">Trusted Brands</span>
                    <h2 class="display-5 text-black mt-2 mb-3">Organisations We Have Supported Across Singapore</h2>
                    <p class="text-dark-gray mb-0" style="font-weight: 400; line-height: 1.8; max-width: 720px;">
                        A rotating selection of brands, institutions, and hospitality groups that have engaged us for fabrication, installation, and branded environmental signage work.
                    </p>
                </div>
            </div>

            <div class="trusted-brands-carousel" id="trustedBrandsCarousel" aria-label="Trusted brands logo carousel">
                <div class="trusted-brands-viewport">
                    <div class="trusted-brands-track">
                        <div class="trusted-brands-item"><img src="assets/images/trusted-brands/bridgestone-logo.png" alt="Bridgestone logo" class="trusted-brand-logo"></div>
                        <div class="trusted-brands-item"><img src="assets/images/trusted-brands/british-club-logo.png" alt="The British Club logo" class="trusted-brand-logo"></div>
                        <div class="trusted-brands-item"><img src="assets/images/trusted-brands/changi-airport-logo.png" alt="Changi Airport logo" class="trusted-brand-logo"></div>
                        <div class="trusted-brands-item"><img src="assets/images/trusted-brands/m1-logo.png" alt="M1 logo" class="trusted-brand-logo"></div>
                        <div class="trusted-brands-item"><img src="assets/images/trusted-brands/marubeni-logo.png" alt="Marubeni logo" class="trusted-brand-logo"></div>
                        <div class="trusted-brands-item"><img src="assets/images/trusted-brands/ritz-carlton-logo.png" alt="The Ritz-Carlton logo" class="trusted-brand-logo"></div>
                        <div class="trusted-brands-item"><img src="assets/images/trusted-brands/temasek-polytechnic-logo.png" alt="Temasek Polytechnic logo" class="trusted-brand-logo"></div>
                    </div>
                </div>
                <div class="trusted-brands-footer">
                    <div class="trusted-brands-dots" data-brand-dots aria-label="Trusted brand pages"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="signboard-showcase" class="developer-showcase-section py-5 border-bottom border-technical">
        <div class="container py-4 py-lg-5">
            <div class="developer-showcase-shell">
                <div class="developer-showcase-content">
                    <div class="developer-showcase-heading">
                        <h2 class="display-font text-uppercase">3D Signages</h2>
                    </div>

                    <div class="developer-showcase-grid">
                        <article class="developer-showcase-card">
                            <img src="assets/images/3d-signages/3d-signages-ubi-ave-stainless-steel.jpeg" alt="3D stainless steel signboard installed at Ubi Avenue Singapore">
                        </article>
                        <article class="developer-showcase-card">
                            <img src="assets/images/3d-signages/3d-signages-jurong-gateway-shopfront-lettering.jpeg" alt="3D shopfront lettering installation at Jurong Gateway Singapore">
                        </article>
                        <article class="developer-showcase-card">
                            <img src="assets/images/3d-signages/3d-signages-woodlands-bracket-signboard.jpeg" alt="Shopfront bracket signboard installation in Woodlands Singapore">
                        </article>
                        <article class="developer-showcase-card">
                            <img src="assets/images/3d-signages/3d-signages-bugis-frontlit-stainless-steel.jpeg" alt="Stainless steel frontlit signage installation in Bugis Singapore">
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="acrylic-showcase" class="developer-showcase-section py-5 border-bottom border-technical">
        <div class="container py-4 py-lg-5">
            <div class="developer-showcase-shell">
                <div class="developer-showcase-content">
                    <div class="developer-showcase-heading">
                        <h2 class="display-font text-uppercase">Acrylic Signage</h2>
                    </div>

                    <div class="developer-showcase-grid">
                        <article class="developer-showcase-card">
                            <img src="assets/images/acrylic-signage/acrylic-signage-anson-road-cut-out-lettering.jpg" alt="Acrylic cut-out lettering installation at Anson Road Singapore">
                        </article>
                        <article class="developer-showcase-card">
                            <img src="assets/images/acrylic-signage/acrylic-signage-toa-payoh-cut-out-signage.jpg" alt="Acrylic cut-out signage installation in Toa Payoh Singapore">
                        </article>
                        <article class="developer-showcase-card">
                            <img src="assets/images/acrylic-signage/acrylic-signage-novena-shopfront.jpg" alt="Acrylic shopfront signage installation in Novena Singapore">
                        </article>
                        <article class="developer-showcase-card">
                            <img src="assets/images/acrylic-signage/acrylic-signage-woodlands-office.jpg" alt="Office acrylic signage installation in Woodlands Singapore">
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="lightbox-showcase" class="developer-showcase-section py-5 border-bottom border-technical">
        <div class="container py-4 py-lg-5">
            <div class="developer-showcase-shell">
                <div class="developer-showcase-content">
                    <div class="developer-showcase-heading">
                        <h2 class="display-font text-uppercase">Lightbox</h2>
                    </div>

                    <div class="developer-showcase-grid">
                        <article class="developer-showcase-card">
                            <img src="assets/images/lightbox/lightbox-holland-village-acrylic-wholelit.jpg" alt="Acrylic wholelit lightbox installation in Holland Village Singapore">
                        </article>
                        <article class="developer-showcase-card">
                            <img src="assets/images/lightbox/lightbox-dickson-double-sided.jpg" alt="Double-sided lightbox installation in Dickson Singapore">
                        </article>
                        <article class="developer-showcase-card">
                            <img src="assets/images/lightbox/lightbox-hanging-installation-singapore.jpg" alt="Hanging lightbox installation in Singapore">
                        </article>
                        <article class="developer-showcase-card">
                            <img src="assets/images/lightbox/lightbox-ang-mo-kio-menu.jpg" alt="Menu lightbox installation in Ang Mo Kio Singapore">
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="sticker-showcase" class="developer-showcase-section py-5 border-bottom border-technical">
        <div class="container py-4 py-lg-5">
            <div class="developer-showcase-shell">
                <div class="developer-showcase-content">
                    <div class="developer-showcase-heading">
                        <h2 class="display-font text-uppercase">Sticker</h2>
                    </div>

                    <div class="developer-showcase-grid">
                        <article class="developer-showcase-card">
                            <img src="assets/images/sticker/sticker-jurong-gateway-hoarding.jpg" alt="Hoarding sticker installation at Jurong Gateway Singapore">
                        </article>
                        <article class="developer-showcase-card">
                            <img src="assets/images/sticker/sticker-orchard-hoarding.jpg" alt="Hoarding sticker installation in Orchard Singapore">
                        </article>
                        <article class="developer-showcase-card">
                            <img src="assets/images/sticker/sticker-seletar-hoarding.jpg" alt="Hoarding sticker installation in Seletar Singapore">
                        </article>
                        <article class="developer-showcase-card">
                            <img src="assets/images/sticker/sticker-katong-wall.jpg" alt="Wall sticker installation in Katong Singapore">
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonials" class="reviews-section py-5 border-bottom border-technical">
        <div class="container py-5">
            <div class="row align-items-end mb-5 g-4">
                <div class="col-lg-12 text-center">
                    <h2 class="display-4 text-black mt-2 mb-3">Trusted By Clients Who Need Signage Delivered Right</h2>
                    <p class="text-dark-gray mb-0 mx-auto" style="font-weight: 400; line-height: 1.8; max-width: 720px;">
                        Business owners, developers, and office fit-out teams rely on us for clear timelines, precise fabrication, and clean on-site installation. Here is a snapshot of the feedback we consistently receive after project handover.
                    </p>
                </div>
            </div>

            <div class="reviews-carousel" id="reviewsCarousel" aria-label="Client testimonials carousel">
                <div class="reviews-carousel-viewport">
                    <div class="reviews-carousel-track">
                        <div class="reviews-carousel-item">
                            <article class="review-card-custom">
                                <span class="review-source"><span class="review-source-dot"></span>Google Review</span>
                                <p class="review-quote">“Very professional from site measurement to final install. The illuminated signboard looked exactly like the approved artwork and the team kept the timeline tight.”</p>
                                <div>
                                    <span class="review-meta-name">Marcus Tan</span>
                                    <span class="review-meta-role">Retail business owner, Singapore</span>
                                </div>
                            </article>
                        </div>
                        <div class="reviews-carousel-item">
                            <article class="review-card-custom">
                                <span class="review-source"><span class="review-source-dot"></span>Google Review</span>
                                <p class="review-quote">“Fast response, clear quotation, and excellent workmanship. Our office branding wall and acrylic lettering were installed neatly with minimal disruption.”</p>
                                <div>
                                    <span class="review-meta-name">Alicia Goh</span>
                                    <span class="review-meta-role">Corporate office manager</span>
                                </div>
                            </article>
                        </div>
                        <div class="reviews-carousel-item">
                            <article class="review-card-custom">
                                <span class="review-source"><span class="review-source-dot"></span>Client Testimonial</span>
                                <p class="review-quote">“They coordinated well with our developer timeline and landlord requirements. The final hoarding, lightbox, and directional signs were consistent and well finished.”</p>
                                <div>
                                    <span class="review-meta-name">Shawn Lim</span>
                                    <span class="review-meta-role">Project coordinator, mixed-use development</span>
                                </div>
                            </article>
                        </div>
                        <div class="reviews-carousel-item">
                            <article class="review-card-custom">
                                <span class="review-source"><span class="review-source-dot"></span>Google Review</span>
                                <p class="review-quote">“The team handled our mall submission requirements properly and the finished signage looked premium. Installation was neat and fast.”</p>
                                <div>
                                    <span class="review-meta-name">Nur Aisyah</span>
                                    <span class="review-meta-role">Retail operations lead</span>
                                </div>
                            </article>
                        </div>
                        <div class="reviews-carousel-item">
                            <article class="review-card-custom">
                                <span class="review-source"><span class="review-source-dot"></span>Client Testimonial</span>
                                <p class="review-quote">“Good communication, realistic lead time, and strong finishing quality. The wayfinding signs and lightbox set were delivered exactly as discussed.”</p>
                                <div>
                                    <span class="review-meta-name">Daniel Chua</span>
                                    <span class="review-meta-role">Facilities manager, commercial building</span>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
                <div class="reviews-carousel-controls">
                    <div class="reviews-carousel-buttons">
                        <button type="button" class="reviews-carousel-button" data-review-prev aria-label="Previous reviews">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                        <button type="button" class="reviews-carousel-button" data-review-next aria-label="Next reviews">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                    <div class="reviews-carousel-dots" data-review-dots aria-label="Review pages"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="estimator" class="py-5 bg-white border-bottom border-technical">
        <div class="container py-5">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.8rem; letter-spacing: 2px;">TRANSPARENT COMMERCIAL VALUATION</span>
                    <h2 class="display-4 text-black mt-2">B2B COST ESTIMATOR</h2>
                    <p class="text-dark-gray" style="font-weight: 400;">
                        Use our mathematical estimation matrix based on localized Singapore production rates (SGD). Calculate your estimated fabrication costs and import the configuration directly to lock in a physical site survey.
                    </p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="estimator-panel">
                        <div class="row g-5">
                            <!-- Input Settings panel -->
                            <div class="col-lg-7">
                                <h4 class="text-black mb-4 border-bottom border-technical pb-2 display-font">1. SIGNAGE CONFIGURATION</h4>
                                
                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <label class="form-label form-label-custom">Signage Service Class / Material</label>
                                        <select class="form-select form-control-custom" id="est-category" onchange="runCostEstimate()">
                                            <option value="led">3D LED Illuminated Signage (Premium Halo/Frontlit)</option>
                                            <option value="corporate-acrylic">Acrylic Raised Laser Cut Lettering (Non-Illuminated)</option>
                                            <option value="metal-stainless">Stainless Steel / Hairline Brass Metal Lettering</option>
                                            <option value="large-vinyl">Outdoor Storefront Decal / Large Format Vinyl Print</option>
                                            <option value="frosting-glass">Frosted Privacy Glass Decal (Per SqM Rate)</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label form-label-custom">Width (Meters)</label>
                                        <input type="number" class="form-control form-control-custom" id="est-width" value="1.8" min="0.2" max="15" step="0.1" oninput="runCostEstimate()">
                                        <div class="form-text text-dark-gray font-monospace" style="font-size: 0.75rem;">Limit: 0.2m - 15m</div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label form-label-custom">Height (Meters)</label>
                                        <input type="number" class="form-control form-control-custom" id="est-height" value="0.9" min="0.2" max="6" step="0.1" oninput="runCostEstimate()">
                                        <div class="form-text text-dark-gray font-monospace" style="font-size: 0.75rem;">Limit: 0.2m - 6m</div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label form-label-custom">Mounting Surface / Elevation</label>
                                        <select class="form-select form-control-custom" id="est-mount" onchange="runCostEstimate()">
                                            <option value="drywall">Standard Indoors (Drywall / Timber panel)</option>
                                            <option value="glass">Glass Panel (Double-Sided adhesive setup)</option>
                                            <option value="external-high">External Facade High Rise (Requires Scaffold / Skylift)</option>
                                            <option value="external-low">External Ground Level Wall (Canopy / Entrance)</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label form-label-custom">Installation Required?</label>
                                        <select class="form-select form-control-custom" id="est-install" onchange="runCostEstimate()">
                                            <option value="yes">Yes (Apex Professional Installation Crew)</option>
                                            <option value="no">No (Supply Only, Delivery only)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Interactive Calculation output board -->
                            <div class="col-lg-5">
                                <div class="output-card h-100 text-center">
                                    <h5 class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 2px;">ESTIMATED PRICE RANGE</h5>
                                    
                                    <div class="my-4">
                                        <span class="text-white display-font display-4" id="price-display">S$1,500 - S$2,100</span>
                                        <p class="text-muted mt-2 mb-0" style="font-size: 0.8rem;">SGD (Excluding dynamic transport/sub-cladding if any)</p>
                                    </div>

                                    <div class="text-start border-top border-technical-subtle pt-4 w-100" style="font-size: 0.8rem;">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">BCA Approval Flag:</span>
                                            <span class="text-white fw-bold font-monospace text-uppercase" id="detail-bca">Not Required</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Est. Lead Time:</span>
                                            <span class="text-white fw-bold font-monospace">8 - 12 Working Days</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Fabrication Tolerances:</span>
                                            <span class="text-white fw-bold font-monospace">+/- 0.5mm CNC router</span>
                                        </div>
                                    </div>

                                    <a href="#quote-form" class="btn-wb-outline text-white border-white w-100 mt-4" onclick="prepopulateQuoteForm()">Proceed to Book Site Survey</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="quote-form" class="py-5 bg-light">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.8rem; letter-spacing: 2px;">SUBMIT DRAWINGS OR PARALIST FOR STRUCTURAL AUDIT</span>
                    <h2 class="display-4 text-black mt-2">REQUEST FORMAL QUOTATION</h2>
                    <p class="text-dark-gray" style="font-weight: 400;">
                        Upload your sign specs or reference photos. Our production estimator team will review your inputs and respond with a formal quotation package within 4 working hours.
                    </p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-9">
                    <div class="border-technical p-4 p-md-5 bg-white">
                        
                        <!-- Success View Interface (No Alert) -->
                        <div id="success-message" class="success-overlay">
                            <i class="fa-solid fa-circle-check text-black mb-4" style="font-size: 4.5rem;"></i>
                            <h3 class="text-black mb-3 text-uppercase display-font">RFQ SUBMITTED SUCCESSFULLY</h3>
                            <p class="text-dark-gray mb-4">
                                Your design parameters have been registered in our system. Reference ID: <span id="ref-id" class="text-black fw-bold font-monospace">APX-02941</span>. A Signage SG estimator will contact you within 4 business hours to finalize site measurements.
                            </p>
                            <button class="btn-wb-solid" onclick="resetForm()">Submit Another Enquiry</button>
                        </div>

                        <!-- Core RFQ Form Elements -->
                        <form id="rfq-form" onsubmit="handleFormSubmission(event)">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label form-label-custom">Company Registered Name *</label>
                                    <input type="text" class="form-control form-control-custom" id="q-company" placeholder="e.g. Apex Hospitality Group SG" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label form-label-custom">Contact Person *</label>
                                    <input type="text" class="form-control form-control-custom" id="q-contact" placeholder="e.g. Rachel Lim" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label form-label-custom">Corporate Email Address *</label>
                                    <input type="email" class="form-control form-control-custom" id="q-email" placeholder="e.g. rachel@apexgroup.sg" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label form-label-custom">Mobile / Contact Number *</label>
                                    <input type="tel" class="form-control form-control-custom" id="q-phone" placeholder="e.g. +65 9234 5678" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label form-label-custom">Target Completion Date</label>
                                    <input type="date" class="form-control form-control-custom" id="q-date">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label form-label-custom">Installation Site Address / Building</label>
                                    <input type="text" class="form-control form-control-custom" id="q-site" placeholder="e.g. Guoco Tower, Level 24">
                                </div>

                                <div class="col-12">
                                    <label class="form-label form-label-custom">Fabrication Path & Scope</label>
                                    <select class="form-select form-control-custom" id="q-scope">
                                        <option value="3d-led">3D LED / Illuminated Frontlit Letters</option>
                                        <option value="lobby-brand">Corporate Office Lobby Backdrop Signage</option>
                                        <option value="frosting">Glass Decals & Privacy Frosted Film Installation</option>
                                        <option value="pylon-ext">Large Scale Pylon & External Architectural Signs</option>
                                        <option value="metal-fab">Specialist Custom Metal Laser Fabrication</option>
                                        <option value="others">Other Custom Architectural Signages</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label form-label-custom">Specifications, Materials & Sizing Details</label>
                                    <textarea class="form-control form-control-custom" id="q-notes" rows="4" placeholder="e.g., Brushed stainless steel profile, 50mm return depth, white halo-lit LED lighting, installation on concrete wall surface."></textarea>
                                </div>

                                <div class="col-12 text-dark-gray" style="font-size: 0.8rem;">
                                    <i class="fa-solid fa-lock me-2 text-black"></i> We comply with the Singapore Personal Data Protection Act (PDPA). All structural details, floor designs, and contact information are kept strictly confidential.
                                </div>

                                <div class="col-12 text-end">
                                    <button type="submit" class="btn-wb-solid py-3 px-5">Submit Request for Quote</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="location-map" class="location-map-section py-5 border-bottom border-technical">
        <div class="container py-4 py-lg-5">
            <div class="row align-items-stretch g-4 g-lg-5">
                <div class="col-lg-5">
                    <div class="location-map-copy h-100">
                        <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.8rem; letter-spacing: 2px;">Visit Our Workshop</span>
                        <h2 class="display-5 text-black mt-2 mb-3">Find Signage SG In Singapore</h2>
                        <p class="text-dark-gray mb-4" style="font-weight: 400; line-height: 1.8;">
                            Drop by our production workshop for material reviews, fabrication discussions, or a site coordination meeting before installation.
                        </p>

                        <div class="location-map-details border-technical">
                            <div class="d-flex align-items-start gap-3">
                                <i class="fa-solid fa-location-dot location-map-icon"></i>
                                <div>
                                    <h3 class="location-map-label">Workshop Address</h3>
                                    <p class="mb-0 text-dark-gray">601 Ang Mo Kio Avenue 5, 560601, Singapore</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <i class="fa-solid fa-clock location-map-icon"></i>
                                <div>
                                    <h3 class="location-map-label">Opening Hours</h3>
                                    <p class="mb-0 text-dark-gray">Mon - Fri: 9.00 a.m. - 6.00 p.m.<br>Sat - Sun: Closed</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <i class="fa-solid fa-phone location-map-icon"></i>
                                <div>
                                    <h3 class="location-map-label">Call Ahead</h3>
                                    <p class="mb-0 text-dark-gray"><a href="https://wa.me/6582861600" class="text-dark-gray text-decoration-none" target="_blank" rel="noopener noreferrer">+65 8286 1600 (Gan)</a></p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <i class="fa-solid fa-envelope location-map-icon"></i>
                                <div>
                                    <h3 class="location-map-label">Email</h3>
                                    <p class="mb-0 text-dark-gray"><a href="mailto:antadv.gan@gmail.com" class="text-dark-gray text-decoration-none">antadv.gan@gmail.com</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-3 mt-4">
                            <a href="https://www.google.com/maps/dir//601+Ang+Mo+Kio+Ave+5,+Singapore+560601/@1.3810727,103.7527332,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x31da17d5f2e7aa53:0x272dd0c8468829ed!2m2!1d103.8351352!2d1.3810741?entry=ttu&g_ep=EgoyMDI0MTAwOC4wIKXMDSoASAFQAw%3D%3D" class="btn-wb-solid" target="_blank" rel="noopener noreferrer">Open In Google Maps</a>
                            <a href="#quote-form" class="btn-wb-outline">Book A Visit</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="location-map-frame-wrap border-technical h-100">
                        <iframe
                            class="location-map-frame"
                            src="https://www.google.com/maps?q=601%20Ang%20Mo%20Kio%20Avenue%205%2C%20560601%2C%20Singapore&z=16&output=embed"
                            title="Signage SG location map"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    </main>

<?php require __DIR__ . '/includes/footer.php'; ?>
