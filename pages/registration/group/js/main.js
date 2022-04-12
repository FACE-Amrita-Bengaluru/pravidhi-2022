/* ===================================================================
 * Spurgeon 1.0.0 - Main JS
 *
 * ------------------------------------------------------------------- */

(function (html) {
    'use strict';

    /* preloader
     * -------------------------------------------------- */
    const ssPreloader = function () {
        const siteBody = document.querySelector('body');
        const preloader = document.querySelector('#preloader');
        if (!preloader) return;

        html.classList.add('ss-preload');

        window.addEventListener('load', function () {
            html.classList.remove('ss-preload');
            html.classList.add('ss-loaded');

            preloader.addEventListener('transitionend', function afterTransition(e) {
                if (e.target.matches('#preloader')) {
                    // siteBody.classList.add('ss-show');
                    e.target.style.display = 'none';
                    preloader.removeEventListener(e.type, afterTransition);
                }
            });
        });
    }; // end ssPreloader

    /* search
     * ------------------------------------------------------ */
    const ssSearch = function () {
        const searchWrap = document.querySelector('.s-header__search');
        const searchTrigger = document.querySelector('.s-header__search-trigger');

        if (!(searchWrap && searchTrigger)) return;

        const searchField = searchWrap.querySelector('.s-header__search-field');
        const closeSearch = searchWrap.querySelector('.s-header__search-close');
        const siteBody = document.querySelector('body');

        searchTrigger.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            siteBody.classList.add('search-is-visible');

            scrollLock.getScrollState()
                ? scrollLock.disablePageScroll(searchWrap)
                : scrollLock.enablePageScroll(searchWrap);

            setTimeout(function () {
                searchWrap.querySelector('.s-header__search-field').focus();
            }, 100);
        });

        closeSearch.addEventListener('click', function (e) {
            e.stopPropagation();

            if (siteBody.classList.contains('search-is-visible')) {
                siteBody.classList.remove('search-is-visible');
                setTimeout(function () {
                    searchWrap.querySelector('.s-header__search-field').blur();
                }, 100);

                scrollLock.getScrollState()
                    ? scrollLock.disablePageScroll(searchWrap)
                    : scrollLock.enablePageScroll(searchWrap);
            }
        });

        searchWrap.addEventListener('click', function (e) {
            if (!e.target.matches('.s-header__search-inner')) {
                closeSearch.dispatchEvent(new Event('click'));
            }
        });

        searchField.addEventListener('click', function (e) {
            e.stopPropagation();
        });

        searchField.setAttribute('placeholder', 'Search for...');
        searchField.setAttribute('autocomplete', 'off');
    }; // end ssSearch

    /* masonry
     * ------------------------------------------------------ */
    const ssMasonry = function () {
        const containerBricks = document.querySelector('.bricks-wrapper');
        if (!containerBricks) return;

        imagesLoaded(containerBricks, function () {
            const msnry = new Masonry(containerBricks, {
                itemSelector: '.entry',
                columnWidth: '.grid-sizer',
                percentPosition: true,
                resize: true,
            });
        });
    }; // end ssMasonry

    /* animate masonry elements if in viewport
     * ------------------------------------------------------ */
    const ssAnimateBricks = function () {
        const animateBlocks = document.querySelectorAll('[data-animate-block]');
        const pageWrap = document.querySelector('.s-pagewrap');
        if (!(pageWrap && animateBlocks)) return;

        // on homepage do animate on scroll
        if (pageWrap.classList.contains('ss-home')) {
            window.addEventListener('scroll', animateOnScroll);
        }

        // animate on scroll
        function animateOnScroll() {
            let scrollY = window.pageYOffset;

            animateBlocks.forEach(function (current) {
                const viewportHeight = window.innerHeight;
                const triggerTop = current.offsetTop + viewportHeight * 0.1 - viewportHeight;
                const blockHeight = current.offsetHeight;
                const blockSpace = triggerTop + blockHeight;
                const inView = scrollY > triggerTop && scrollY <= blockSpace;
                const isAnimated = current.classList.contains('ss-animated');

                if (inView && !isAnimated) {
                    doAnimate(current);
                }
            });
        }
    }; // end ssAnimateOnScroll

    /* swiper
     * ------------------------------------------------------ */
    const ssSwiper = function () {
        const mySwiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            effect: 'fade',
            speed: 1000,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                renderBullet: function (index, className) {
                    return '<span class="' + className + '">' + (index + 1) + '</span>';
                },
            },
        });
    }; // end ssSwiper

    /* alert boxes
     * ------------------------------------------------------ */
    const ssAlertBoxes = function () {
        const boxes = document.querySelectorAll('.alert-box');

        boxes.forEach(function (box) {
            box.addEventListener('click', function (event) {
                if (event.target.matches('.alert-box__close')) {
                    event.stopPropagation();
                    event.target.parentElement.classList.add('hideit');

                    setTimeout(function () {
                        box.style.display = 'none';
                    }, 500);
                }
            });
        });
    }; // end ssAlertBoxes

    /* Back to Top
     * ------------------------------------------------------ */
    const ssBackToTop = function () {
        const pxShow = 900;
        const goTopButton = document.querySelector('.ss-go-top');

        if (!goTopButton) return;

        // Show or hide the button
        if (window.scrollY >= pxShow) goTopButton.classList.add('link-is-visible');

        window.addEventListener('scroll', function () {
            if (window.scrollY >= pxShow) {
                if (!goTopButton.classList.contains('link-is-visible'))
                    goTopButton.classList.add('link-is-visible');
            } else {
                goTopButton.classList.remove('link-is-visible');
            }
        });
    }; // end ssBackToTop

    /* smoothscroll
     * ------------------------------------------------------ */
    const ssMoveTo = function () {
        const easeFunctions = {
            easeInQuad: function (t, b, c, d) {
                t /= d;
                return c * t * t + b;
            },
            easeOutQuad: function (t, b, c, d) {
                t /= d;
                return -c * t * (t - 2) + b;
            },
            easeInOutQuad: function (t, b, c, d) {
                t /= d / 2;
                if (t < 1) return (c / 2) * t * t + b;
                t--;
                return (-c / 2) * (t * (t - 2) - 1) + b;
            },
            easeInOutCubic: function (t, b, c, d) {
                t /= d / 2;
                if (t < 1) return (c / 2) * t * t * t + b;
                t -= 2;
                return (c / 2) * (t * t * t + 2) + b;
            },
        };

        const triggers = document.querySelectorAll('.smoothscroll');

        const moveTo = new MoveTo(
            {
                tolerance: 0,
                duration: 1200,
                easing: 'easeInOutCubic',
                container: window,
            },
            easeFunctions
        );

        triggers.forEach(function (trigger) {
            moveTo.registerTrigger(trigger);
        });
    }; // end ssMoveTo

    /* Initialize
     * ------------------------------------------------------ */
    (function ssInit() {
        ssPreloader();
        ssSearch();
        ssMasonry();
        ssAnimateBricks();
        ssSwiper();
        ssAlertBoxes();
        ssBackToTop();
        ssMoveTo();
    })();
})(document.documentElement);

const teamSizeInput = document.querySelector('.team-size');

teamSizeInput.addEventListener('input', () => {
    const allDynamicInputs = document.querySelectorAll('.dynamic-input');

    allDynamicInputs.forEach(input => {
        input.remove();
    });

    const teamSize = Number(teamSizeInput.value);
    const teamSizeDiv = document.querySelector('.team-size-input');
    const nameHTML = `<div class="column lg-6 tab-12 form-field">
                        <input
                            name="cName"
                            id="cName"
                            class="u-fullwidth dynamic-input"
                            placeholder="Name"
                            value=""
                            type="text"
                        />
                    </div>`;
    const registrationNumberHTML = `<div class="column lg-6 tab-12 form-field">
                                        <input
                                            name="cEmail"
                                            id="cEmail"
                                            class="u-fullwidth dynamic-input"
                                            placeholder="Registration Number"
                                            value=""
                                            type="text"
                                        />
                                    </div>`;
    const semesterHTML = `<div class="column lg-6 tab-12 form-field dynamic-input">
                            <div class="ss-custom-select">
                                <select class="u-fullwidth" id="sampleRecipientInput">
                                    <option value="" hidden>Semester</option>
                                    <option value="">4</option>
                                    <option value="">6</option>
                                </select>
                            </div>
                        </div>`;
    const branchHTML = `<div class="column lg-6 tab-12 form-field dynamic-input">
                            <div class="ss-custom-select">
                                <select class="u-fullwidth" id="sampleRecipientInput">
                                    <option value="" hidden>Branch</option>
                                    <option value="CSE">CSE</option>
                                    <option value="AIE">AIE</option>
                                    <option value="ECE">ECE</option>
                                    <option value="EAC">EAC</option>
                                    <option value="MEE">MEE</option>
                                    <option value="EEE">EEE</option>
                                </select>
                            </div>
                        </div>`;
    const whatsappNumberHTML = `<div class="column lg-6 tab-12 form-field">
                                    <input
                                        name="cEmail"
                                        id="cEmail"
                                        class="u-fullwidth dynamic-input"
                                        placeholder="WhatsApp Number"
                                        value=""
                                        type="text"
                                    />
                                </div>`;

    const emailHTML = `<div class="column lg-6 tab-12 form-field">
                            <input
                                name="cEmail"
                                id="cEmail"
                                class="u-fullwidth dynamic-input"
                                placeholder="Email"
                                value=""
                                type="text"
                            />
                        </div>`;

    for (let i = teamSize; i > 0; i--) {
        const teamNumberHTML = `<h4 class="dynamic-input" style="width: 100%">Team Member ${i}</h4>`;

        teamSizeDiv.insertAdjacentHTML('afterend', emailHTML);
        teamSizeDiv.insertAdjacentHTML('afterend', whatsappNumberHTML);
        teamSizeDiv.insertAdjacentHTML('afterend', branchHTML);
        teamSizeDiv.insertAdjacentHTML('afterend', semesterHTML);
        teamSizeDiv.insertAdjacentHTML('afterend', registrationNumberHTML);
        teamSizeDiv.insertAdjacentHTML('afterend', nameHTML);
        teamSizeDiv.insertAdjacentHTML('afterend', teamNumberHTML);
    }
});
