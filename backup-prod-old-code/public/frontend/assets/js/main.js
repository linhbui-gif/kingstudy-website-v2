window.onload = () => {
    menu.init(), owlCarousel.init(), tab.init(), collapse.init(), modal.init(), submitFileStep.init(), updateInfoSturyAbroadStep.init(), wowJs.init()
};
const menu = {
    init: function () {
        this.menuMobile(), this.accountMenuDekstop(), this.accountMenuMobile()
    }, menuMobile: function () {
        const e = document.querySelector(".header-mobile .Header-actions-item.menu"),
            t = document.querySelector(".header-mobile .Navigation"),
            s = t.querySelector(".header-mobile .Navigation-close"),
            a = t.querySelector(".header-mobile .Navigation-overlay");
        e.addEventListener("click", (() => {
            t.classList.add("active")
        })), s.addEventListener("click", (() => {
            t.classList.remove("active")
        })), a.addEventListener("click", (() => {
            t.classList.remove("active")
        }))
    }, accountMenuDekstop: function () {
        const e = document.querySelector(".header-desktop .Header-actions-item.account"),
            t = document.querySelector(".header-desktop .DropdownAccount");
        e?.addEventListener("click", (() => {
            t.classList.toggle("active")
        }));
        const s = e => {
            t && !t.contains(e.target) && t?.classList?.remove("active")
        };
        document.addEventListener("mousedown", s), document.addEventListener("touchstart", s)
    }, accountMenuMobile: function () {
        const e = document.querySelector(".header-mobile .Header-actions-item.account"),
            t = document.querySelector(".header-mobile .DropdownAccount");
        e?.addEventListener("click", (() => {
            t.classList.toggle("active")
        }));
        const s = e => {
            t && !t.contains(e.target) && t?.classList?.remove("active")
        };
        document.addEventListener("mousedown", s), document.addEventListener("touchstart", s)
    }
}, owlCarousel = {
    init: function () {
        this.setupHomeBannerCarousel(), this.setupCustomersCarousel(), this.setupEventsCarousel(), this.setupCoreValuesCarousel(), this.setupFeedbacksCarousel(), this.setupModalAuthCarousel(), this.setupFeedbackCarousel(), this.setupGalleryCarousel(), this.setupRelatedSchoolCarousel(), this.setupPartnersCarousel(), this.setupModalAuthRegisterCarousel(), this.setupModalAuthResetCarousel()
    }, setupHomeBannerCarousel: function () {
        $("#HomeBanner-carousel").owlCarousel({
            responsive: {0: {items: 1, slideBy: 1}},
            loop: !0,
            autoplay: !0,
            autoplayTimeout: 4e3,
            autoplayHoverPause: !0,
            smartSpeed: 300,
            dots: !1,
            nav: !1,
            margin: 0
        })
    }, setupCustomersCarousel: function () {
        $("#Customers-carousel").owlCarousel({
            responsive: {
                0: {items: 1.3, slideBy: 1.3, margin: 16},
                768: {items: 3, slideBy: 1}
            },
            loop: !1,
            autoplay: !1,
            autoplayTimeout: 4e3,
            autoplayHoverPause: !0,
            smartSpeed: 300,
            lazyLoad: !0,
            dots: !0,
            nav: !0,
            navText: ['<img src="/frontend/assets/icons/icon-angle-left.svg" alt="" />', '<img src="/frontend/assets/icons/icon-angle-right.svg" alt="" />'],
            margin: 20
        })
    }, setupEventsCarousel: function () {
        $("#Events-carousel").owlCarousel({
            responsive: {
                0: {items: 1, slideBy: 1, margin: 16},
                768: {items: 3, slideBy: 1, margin: 16},
                991: {items: 3, slideBy: 1}
            },
            loop: !0,
            autoplay: !0,
            autoplayTimeout: 4e3,
            autoplayHoverPause: !0,
            smartSpeed: 300,
            lazyLoad: !0,
            dots: !0,
            nav: !1,
            margin: 10
        })
    }, setupCoreValuesCarousel: function () {
        $("#CoreValues-carousel").owlCarousel({
            responsive: {
                0: {items: 1, slideBy: 1},
                768: {items: 2, slideBy: 1},
                991: {items: 3, slideBy: 1}
            },
            loop: !0,
            autoplay: !0,
            autoplayTimeout: 4e3,
            autoplayHoverPause: !0,
            smartSpeed: 300,
            lazyLoad: !0,
            dots: !1,
            nav: !0,
            navText: ['<img src="/frontend/assets/icons/icon-angle-circle-left.svg" alt="" />', '<img src="/frontend/assets/icons/icon-angle-circle-right.svg" alt="" />'],
            margin: 20
        })
    }, setupFeedbackCarousel: function () {
        $("#Feedback-carousel").owlCarousel({
            responsive: {
                0: {items: 1, slideBy: 1, margin: 16},
                768: {items: 3, slideBy: 1, margin: 16},
                991: {items: 3, slideBy: 1}
            },
            loop: !1,
            autoplay: !0,
            autoplayTimeout: 4e3,
            autoplayHoverPause: !0,
            smartSpeed: 300,
            lazyLoad: !0,
            dots: !0,
            nav: !0,
            margin: 20
        })
    }, setupFeedbacksCarousel: function () {
        $("#Feedbacks-carousel").owlCarousel({
            responsive: {
                0: {items: 1, slideBy: 1},
                768: {items: 2, slideBy: 1},
                991: {items: 3, slideBy: 1}
            },
            loop: !0,
            autoplay: !0,
            autoplayTimeout: 4e3,
            autoplayHoverPause: !0,
            smartSpeed: 300,
            lazyLoad: !0,
            dots: !0,
            nav: !1,
            navText: ['<img src="/frontend/assets/icons/icon-angle-circle-left.svg" alt="" />', '<img src="/frontend/assets/icons/icon-angle-circle-right.svg" alt="" />'],
            margin: 20
        })
    }, setupGalleryCarousel: function () {
        $("#Gallery-carousel").owlCarousel({
            responsive: {
                0: {items: 1, slideBy: 1},
                768: {items: 2, slideBy: 1},
                991: {items: 3, slideBy: 1}
            },
            loop: !0,
            autoplay: !0,
            autoplayTimeout: 4e3,
            autoplayHoverPause: !0,
            smartSpeed: 300,
            lazyLoad: !0,
            dots: !1,
            nav: !1,
            navText: ['<img src="/frontend/assets/icons/icon-angle-circle-left.svg" alt="" />', '<img src="/frontend/assets/icons/icon-angle-circle-right.svg" alt="" />'],
            margin: 20
        })
    }, setupRelatedSchoolCarousel: function () {
        $("#RelatedSchool-carousel").owlCarousel({
            responsive: {
                0: {items: 1, slideBy: 1},
                768: {items: 2, slideBy: 1},
                991: {items: 4, slideBy: 1}
            },
            loop: !1,
            autoplay: !1,
            autoplayTimeout: 4e3,
            autoplayHoverPause: !0,
            smartSpeed: 300,
            lazyLoad: !0,
            dots: !1,
            nav: !1,
            navText: ['<img src="/frontend/assets/icons/icon-angle-circle-left.svg" alt="" />', '<img src="/frontend/assets/icons/icon-angle-circle-right.svg" alt="" />'],
            margin: 20
        })
    }, setupModalAuthCarousel: function () {
        $("#ModalAuth-carousel").owlCarousel({
            responsive: {0: {items: 1, slideBy: 1}},
            loop: !0,
            autoplay: !0,
            autoplayTimeout: 4e3,
            autoplayHoverPause: !0,
            smartSpeed: 300,
            lazyLoad: !0,
            dots: !0,
            nav: !1,
            navText: ['<img src="/frontend/assets/icons/icon-angle-circle-left.svg" alt="" />', '<img src="/frontend/assets/icons/icon-angle-circle-right.svg" alt="" />'],
            margin: 0
        })
    }, setupModalAuthRegisterCarousel: function () {
        $("#ModalRegister-carousel").owlCarousel({
            responsive: {0: {items: 1, slideBy: 1}},
            loop: !0,
            autoplay: !0,
            autoplayTimeout: 4e3,
            autoplayHoverPause: !0,
            smartSpeed: 300,
            lazyLoad: !0,
            dots: !0,
            nav: !1,
            navText: ['<img src="/frontend/assets/icons/icon-angle-circle-left.svg" alt="" />', '<img src="/frontend/assets/icons/icon-angle-circle-right.svg" alt="" />'],
            margin: 0
        })
    }, setupModalAuthResetCarousel: function () {
        $("#ModalReset-carousel").owlCarousel({
            responsive: {0: {items: 1, slideBy: 1}},
            loop: !0,
            autoplay: !0,
            autoplayTimeout: 4e3,
            autoplayHoverPause: !0,
            smartSpeed: 300,
            lazyLoad: !0,
            dots: !0,
            nav: !1,
            navText: ['<img src="/frontend/assets/icons/icon-angle-circle-left.svg" alt="" />', '<img src="/frontend/assets/icons/icon-angle-circle-right.svg" alt="" />'],
            margin: 0
        })
    }, setupPartnersCarousel: function () {
        $("#Partners-carousel").owlCarousel({
            responsive: {
                0: {items: 2, slideBy: 1},
                768: {items: 3, slideBy: 1},
                991: {items: 7, slideBy: 1}
            },
            loop: !0,
            autoplay: !0,
            autoplayTimeout: 4e3,
            autoplayHoverPause: !0,
            smartSpeed: 300,
            lazyLoad: !0,
            dots: 0,
            nav: 0,
            // navText: ['<img src="/frontend/assets/icons/icon-angle-left.svg" alt="" />', '<img src="/frontend/assets/icons/icon-angle-right.svg" alt="" />'],
            margin: 20
        })
    }
}, tab = {
    init: function () {
        this.config()
    }, config: function () {
        document.querySelectorAll(".Tab").forEach((e => {
            const t = e.querySelectorAll(".Tab-header-item"), s = e.querySelectorAll(".Tab-main-item");
            t.forEach(((e, a) => e.addEventListener("click", (() => {
                t.forEach((e => e.classList.remove("active"))), s.forEach((e => e.classList.remove("active"))), t[a]?.classList?.add("active"), s[a]?.classList?.add("active")
            })))), t[0]?.classList?.add("active"), s[0]?.classList?.add("active")
        }))
    }
}, collapse = {
    init: function () {
        this.config()
    }, config: function () {
        document.querySelectorAll(".Collapse").forEach((e => {
            e.querySelector(".Collapse-header").addEventListener("click", (() => {
                e.classList.toggle("active")
            }))
        }))
    }
}, modal = {
    init: function () {
        this.config()
    }, config: function () {
        document.querySelectorAll(".js-open-modal").forEach((e => e.addEventListener("click", (() => {
            const t = e.dataset.modalId;
            console.log(e.dataset);
            const s = document.querySelector(t);
            if (s) {
                s.classList.add("active");
                const e = s.querySelector(".Modal-overlay"), t = s.querySelectorAll(".Modal-close");
                e.addEventListener("click", (() => {
                    s.classList.remove("active"), console.log(e)
                })), t.forEach((e => e.addEventListener("click", (() => {
                    s.classList.remove("active")
                }))))
            }
        }))))
    }
}, submitFileStep = {
    init: function () {
        this.configSubmitFilePage(), this.configUpdateFilesPage()
    }, configSubmitFilePage: function () {
        let e = 0;
        const t = document.querySelectorAll(".SubmitFilePage-step-header-item"),
            s = document.querySelectorAll(".SubmitFilePage-step-body-item"),
            a = document.querySelectorAll(".SubmitFilePage-form-submit"), o = e => {
                t.forEach((e => e.classList.remove("active"))), s.forEach((e => e.classList.remove("active"))), t?.[e]?.classList?.add("active"), s?.[e]?.classList?.add("active")
            };
        o(e), a.forEach((s => s.addEventListener("click", (() => {
            var s = !0;
            if (0 == e && (s = validateStep1()), !s) return !1;
            e < t.length - 1 && (e += 1, o(e))
        })))), t.forEach(((t, s) => t.addEventListener("click", (() => {
            e = s, o(e)
        }))))
    }, configUpdateFilesPage: function () {
        let e = 0;
        const t = document.querySelectorAll(".SubmitFilePage-step-header-item"),
            s = document.querySelectorAll(".UpdateInfoSturyAbroad-step"),
            a = document.querySelectorAll(".UpdateInfoSturyAbroad-step-submit"), o = e => {
                t.forEach((e => e.classList.remove("active"))), s.forEach((e => e.classList.remove("active"))), t?.[e]?.classList?.add("active"), s?.[e]?.classList?.add("active")
            };
        o(e), a.forEach((s => s.addEventListener("click", (() => {
            e < t.length - 1 && (e += 1, o(e))
        })))), t.forEach(((t, s) => t.addEventListener("click", (() => {
            e = s, o(e)
        }))))
    }
}, updateInfoSturyAbroadStep = {
    init: function () {
        this.config()
    }, config: function () {
        let e = 0;
        const t = document.querySelectorAll(".UpdateInfoSturyAbroad-step"),
            s = document.querySelectorAll(".UpdateInfoSturyAbroad-step-submit"), a = e => {
                window.scrollTo(0, 0), t.forEach((e => e.classList.remove("active"))), t?.[e]?.classList?.add("active")
            };
        a(e), s.forEach((t => t.addEventListener("click", (() => {
            e < s.length - 1 && (e += 1, a(e))
        }))))
    }
}, wowJs = {
    init: function () {
        this.config()
    }, config: function () {
        (new WOW).init()
    }
};

function validateStep1() {
    return $(".error").remove(), "" == $("#full_name").val() ? ($("<label class='error'>Họ tên không được rỗng </label>").insertAfter("#full_name"), !1) : "" == $("#phone").val() ? ($("<label class='error'>Số điện thoại không được rỗng </label>").insertAfter("#phone"), !1) : "" == $("#email_user").val() ? ($("<label class='error'>Email không được rỗng </label>").insertAfter("#email_user"), !1) : "" == $("#country_id").val() ? ($("<label class='error'>Quốc gia không được rỗng</label>").insertAfter("#country_id"), !1) : "" != $("#level_id").val() || ($("<label class='error'>Bật học không được rỗng</label>").insertAfter("#level_id"), !1)
}

var tabLinks = document.querySelectorAll(".list-link .nav .menu-item .menu-item-link"),
    tabContent = document.querySelectorAll(".tab-contents");

function openTabs(e) {
    var t = e.currentTarget, s = t.dataset.electronic;
    tabContent.forEach((function (e) {
        e.classList.remove("active")
    })), tabLinks.forEach((function (e) {
        e.classList.remove("active")
    })), document.querySelector("#" + s).classList.add("active"), t.classList.add("active")
}

tabLinks.forEach((function (e) {
    e.addEventListener("click", openTabs)
}));
const openSidebar = {
    init: function () {
        this.show()
    }, show: function () {
        let e = document.querySelector(".icon-mobile"), t = document.querySelector(".header__link .list-link"),
            s = document.querySelector(".overlay");
        e && e.addEventListener("click", (function () {
            t.classList.toggle("show"), this.classList.add("hide"), s.classList.add("overlay-active")
        }))
    }, hideOverlay: function () {
        let e = document.querySelector(".icon-mobile"), t = document.querySelector(".header__link .list-link"),
            s = document.querySelector(".overlay");
        s.addEventListener("click", (function () {
            t.classList.remove("show"), e.classList.remove("hide"), s.classList.remove("overlay-active")
        }))
    }
};
openSidebar.init();
