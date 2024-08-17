window.onload = () => {
  menu.init();
  owlCarousel.init();
  tab.init();
  collapse.init();
  modal.init();
  submitFileStep.init();
  updateInfoSturyAbroadStep.init();
  wowJs.init();
};

const menu = {
  init: function () {
    this.menuMobile();
    this.accountMenu();
  },
  menuMobile: function () {
    const btn = document.querySelector(".Header-actions-item.menu");
    const main = document.querySelector(".Navigation");
    const closeBtn = main.querySelector(".Navigation-close");
    const overlay = main.querySelector(".Navigation-overlay");

    btn.addEventListener("click", () => {
      main.classList.add("active");
    });

    closeBtn.addEventListener("click", () => {
      main.classList.remove("active");
    });

    overlay.addEventListener("click", () => {
      main.classList.remove("active");
    });
  },
  accountMenu: function () {
    const openBtn = document.querySelector(".Header-actions-item.account");
    const main = document.querySelector(".DropdownAccount");

    openBtn?.addEventListener("click", () => {
      main.classList.add("active");
    });

    const listener = (event) => {
      if (!main || main.contains(event.target)) {
        return;
      }
      main?.classList?.remove("active");
    };
    document.addEventListener("mousedown", listener);
    document.addEventListener("touchstart", listener);
  },
};

const owlCarousel = {
  init: function () {
    this.setupHomeBannerCarousel();
    this.setupCustomersCarousel();
    this.setupEventsCarousel();
    this.setupCoreValuesCarousel();
    this.setupFeedbacksCarousel();
    this.setupModalAuthCarousel();
    this.setupFeedbackCarousel();
    this.setupGalleryCarousel();
    this.setupRelatedSchoolCarousel();
    this.setupPartnersCarousel();
  },
  setupHomeBannerCarousel: function () {
    const $owl = $("#HomeBanner-carousel").owlCarousel({
      responsive: {
        0: {
          items: 1,
          slideBy: 1,
        },
      },
      loop: true,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      smartSpeed: 300,
      lazyLoad: true,
      dots: false,
      nav: false,
      // navText: [
      //   '<img src="./assets/icons/icon-arrow-left-white.svg" alt="" />',
      //   '<img src="./assets/icons/icon-arrow-right-white.svg" alt="" />',
      // ],
      margin: 0,
    });
  },
  setupCustomersCarousel: function () {
    const $owl = $("#Customers-carousel").owlCarousel({
      responsive: {
        0: {
          items: 1.3,
          slideBy: 1.3,
          margin: 16,
        },
        768: {
          items: 3,
          slideBy: 1,
        },
      },
      loop: true,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      smartSpeed: 300,
      lazyLoad: true,
      dots: true,
      nav: true,
      navText: [
        '<img src="./assets/icons/icon-angle-left.svg" alt="" />',
        '<img src="./assets/icons/icon-angle-right.svg" alt="" />',
      ],
      margin: 20,
    });
  },
  setupEventsCarousel: function () {
    const $owl = $("#Events-carousel").owlCarousel({
      responsive: {
        0: {
          items: 1,
          slideBy: 1,
          margin: 16,
        },
        768: {
          items: 3,
          slideBy: 1,
          margin: 16,
        },
        991: {
          items: 3,
          slideBy: 1,
        },
      },
      loop: true,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      smartSpeed: 300,
      lazyLoad: true,
      dots: true,
      nav: false,
      // navText: [
      //   '<img src="./assets/icons/icon-arrow-left-white.svg" alt="" />',
      //   '<img src="./assets/icons/icon-arrow-right-white.svg" alt="" />',
      // ],
      margin: 10,
    });
  },
  setupCoreValuesCarousel: function () {
    const $owl = $("#CoreValues-carousel").owlCarousel({
      responsive: {
        0: {
          items: 1,
          slideBy: 1,
        },
        768: {
          items: 2,
          slideBy: 1,
        },
        991: {
          items: 3,
          slideBy: 1,
        },
      },
      loop: true,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      smartSpeed: 300,
      lazyLoad: true,
      dots: false,
      nav: true,
      navText: [
        '<img src="./assets/icons/icon-angle-circle-left.svg" alt="" />',
        '<img src="./assets/icons/icon-angle-circle-right.svg" alt="" />',
      ],
      margin: 20,
    });
  },
  setupFeedbackCarousel: function () {
    const $owl = $("#Feedback-carousel").owlCarousel({
      responsive: {
        0: {
          items: 1,
          slideBy: 1,
          margin: 16,
        },
        768: {
          items: 3,
          slideBy: 1,
          margin: 16,
        },
        991: {
          items: 3,
          slideBy: 1,
        },
      },
      loop: true,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      smartSpeed: 300,
      lazyLoad: true,
      dots: true,
      nav: false,
      // navText: [
      //   '<img src="./assets/icons/icon-arrow-left-white.svg" alt="" />',
      //   '<img src="./assets/icons/icon-arrow-right-white.svg" alt="" />',
      // ],
      margin: 20,
    });
  },
  setupFeedbacksCarousel: function () {
    const $owl = $("#Feedbacks-carousel").owlCarousel({
      responsive: {
        0: {
          items: 1,
          slideBy: 1,
        },
        768: {
          items: 2,
          slideBy: 1,
        },
        991: {
          items: 3,
          slideBy: 1,
        },
      },
      loop: true,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      smartSpeed: 300,
      lazyLoad: true,
      dots: false,
      nav: false,
      navText: [
        '<img src="./assets/icons/icon-angle-circle-left.svg" alt="" />',
        '<img src="./assets/icons/icon-angle-circle-right.svg" alt="" />',
      ],
      margin: 20,
    });
  },
  setupGalleryCarousel: function () {
    const $owl = $("#Gallery-carousel").owlCarousel({
      responsive: {
        0: {
          items: 1,
          slideBy: 1,
        },
        768: {
          items: 2,
          slideBy: 1,
        },
        991: {
          items: 3,
          slideBy: 1,
        },
      },
      loop: true,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      smartSpeed: 300,
      lazyLoad: true,
      dots: false,
      nav: false,
      navText: [
        '<img src="./assets/icons/icon-angle-circle-left.svg" alt="" />',
        '<img src="./assets/icons/icon-angle-circle-right.svg" alt="" />',
      ],
      margin: 20,
    });
  },
  setupRelatedSchoolCarousel: function () {
    const $owl = $("#RelatedSchool-carousel").owlCarousel({
      responsive: {
        0: {
          items: 1,
          slideBy: 1,
        },
        768: {
          items: 2,
          slideBy: 1,
        },
        991: {
          items: 3,
          slideBy: 1,
        },
      },
      loop: true,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      smartSpeed: 300,
      lazyLoad: true,
      dots: false,
      nav: false,
      navText: [
        '<img src="./assets/icons/icon-angle-circle-left.svg" alt="" />',
        '<img src="./assets/icons/icon-angle-circle-right.svg" alt="" />',
      ],
      margin: 20,
    });
  },
  setupModalAuthCarousel: function () {
    const $owl = $("#ModalAuth-carousel").owlCarousel({
      responsive: {
        0: {
          items: 1,
          slideBy: 1,
        },
      },
      loop: true,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      smartSpeed: 300,
      lazyLoad: true,
      dots: true,
      nav: false,
      navText: [
        '<img src="./assets/icons/icon-angle-circle-left.svg" alt="" />',
        '<img src="./assets/icons/icon-angle-circle-right.svg" alt="" />',
      ],
      margin: 0,
    });
  },
  setupPartnersCarousel: function () {
    const $owl = $("#Partners-carousel").owlCarousel({
      responsive: {
        0: {
          items: 2,
          slideBy: 1,
        },
        768: {
          items: 3,
          slideBy: 1,
        },
        991: {
          items: 7,
          slideBy: 1,
        },
      },
      loop: true,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      smartSpeed: 300,
      lazyLoad: true,
      dots: true,
      nav: true,
      navText: [
        '<img src="./assets/icons/icon-angle-left.svg" alt="" />',
        '<img src="./assets/icons/icon-angle-right.svg" alt="" />',
      ],
      margin: 20,
    });
  },
};

const tab = {
  init: function () {
    this.config();
  },
  config: function () {
    const mains = document.querySelectorAll(".Tab");
    mains.forEach((main) => {
      const tabItems = main.querySelectorAll(".Tab-header-item");
      const tabMainItems = main.querySelectorAll(".Tab-main-item");

      tabItems.forEach((item, index) =>
        item.addEventListener("click", () => {
          tabItems.forEach((i) => i.classList.remove("active"));
          tabMainItems.forEach((i) => i.classList.remove("active"));

          tabItems[index]?.classList?.add("active");
          tabMainItems[index]?.classList?.add("active");
        })
      );

      tabItems[0]?.classList?.add("active");
      tabMainItems[0]?.classList?.add("active");
    });
  },
};

const collapse = {
  init: function () {
    this.config();
  },
  config: function () {
    const mains = document.querySelectorAll(".Collapse");

    mains.forEach((item) => {
      const header = item.querySelector(".Collapse-header");
      header.addEventListener("click", () => {
        item.classList.toggle("active");
      });
    });
  },
};

const modal = {
  init: function () {
    this.config();
  },
  config: function () {
    const openBtn = document.querySelectorAll(".js-open-modal");
    openBtn.forEach((item) =>
      item.addEventListener("click", () => {
        const targetId = item.dataset.modalId;
        console.log(item.dataset);

        const modal = document.querySelector(targetId);

        if (modal) {
          modal.classList.add("active");
          const overlay = modal.querySelector(".Modal-overlay");
          const close = modal.querySelectorAll(".Modal-close");

          overlay.addEventListener("click", () => {
            modal.classList.remove("active");
          });
          close.forEach((item) =>
            item.addEventListener("click", () => {
              modal.classList.remove("active");
            })
          );
        }
      })
    );
  },
};

const submitFileStep = {
  init: function () {
    this.configSubmitFilePage();
    this.configUpdateFilesPage();
  },
  configSubmitFilePage: function () {
    let step = 0;
    const stepHeader = document.querySelectorAll(
      ".SubmitFilePage-step-header-item"
    );
    const stepBody = document.querySelectorAll(
      ".SubmitFilePage-step-body-item"
    );
    const nextStepBtn = document.querySelectorAll(
      ".SubmitFilePage-form-submit"
    );

    const triggerStep = (currentStep) => {
      stepHeader.forEach((i) => i.classList.remove("active"));
      stepBody.forEach((i) => i.classList.remove("active"));

      stepHeader?.[currentStep]?.classList?.add("active");
      stepBody?.[currentStep]?.classList?.add("active");
    };

    triggerStep(step);

    nextStepBtn.forEach((item) =>
      item.addEventListener("click", () => {
        if (step < stepHeader.length - 1) {
          step += 1;
          triggerStep(step);
        }
      })
    );

    stepHeader.forEach((item, index) =>
      item.addEventListener("click", () => {
        step = index;
        triggerStep(step);
      })
    );
  },
  configUpdateFilesPage: function () {
    let step = 0;
    const stepHeader = document.querySelectorAll(
      ".SubmitFilePage-step-header-item"
    );
    const stepBody = document.querySelectorAll(
      ".UpdateInfoSturyAbroad-step"
    );
    const nextStepBtn = document.querySelectorAll(
      ".UpdateInfoSturyAbroad-step-submit"
    );

    const triggerStep = (currentStep) => {
      stepHeader.forEach((i) => i.classList.remove("active"));
      stepBody.forEach((i) => i.classList.remove("active"));

      stepHeader?.[currentStep]?.classList?.add("active");
      stepBody?.[currentStep]?.classList?.add("active");
    };

    triggerStep(step);

    nextStepBtn.forEach((item) =>
      item.addEventListener("click", () => {
        if (step < stepHeader.length - 1) {
          step += 1;
          triggerStep(step);
        }
      })
    );

    stepHeader.forEach((item, index) =>
      item.addEventListener("click", () => {
        step = index;
        triggerStep(step);
      })
    );
  },
};

const updateInfoSturyAbroadStep = {
  init: function () {
    this.config();
  },
  config: function () {
    let step = 0;
    const main = document.querySelectorAll(".UpdateInfoSturyAbroad-step");
    const nextStepBtn = document.querySelectorAll(
      ".UpdateInfoSturyAbroad-step-submit"
    );

    const triggerStep = (currentStep) => {
      window.scrollTo(0,0);
      main.forEach((i) => i.classList.remove("active"));
      main?.[currentStep]?.classList?.add("active");
    };

    triggerStep(step);

    nextStepBtn.forEach((item) =>
      item.addEventListener("click", () => {
        if (step < nextStepBtn.length - 1) {
          step += 1;
          triggerStep(step);
        }
      })
    );
  },
};


const wowJs = {
  init: function() {
    this.config()
  },
  config: function() {
    new WOW().init();
  },
}
