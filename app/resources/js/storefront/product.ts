export {};

declare global {
  interface Window {
    AJAX?: (
      action: string,
      parameters: { itemId: string | undefined; email: string },
      mode: string,
    ) => Promise<unknown> | unknown;
  }
}

function setVisible(element: HTMLElement, visible: boolean) {
  if (!visible) {
    element.style.display = "none";
    return;
  }

  element.style.display = "";

  if (getComputedStyle(element).display === "none") {
    element.style.display = element instanceof HTMLButtonElement ? "inline-block" : "block";
  }
}

function initializeProductPage() {
  document.querySelectorAll<HTMLElement>(".product-other-img").forEach((image) => {
    image.addEventListener("click", () => {
      const fileUrl = image.dataset.src;
      const fileType = image.dataset.type;

      document.querySelectorAll(".product-spotlight").forEach((spotlight) => {
        spotlight.classList.remove("active");

        if (fileType && spotlight.classList.contains(`product-${fileType}`)) {
          if (fileUrl) {
            spotlight.setAttribute("src", fileUrl);
          }

          spotlight.classList.add("active");
        }
      });

      document.querySelectorAll(".product-other-img").forEach((otherImage) => {
        otherImage.classList.remove("active");
      });

      image.classList.add("active");
    });
  });

  document.querySelectorAll<HTMLElement>(".play-main-video").forEach((button) => {
    button.addEventListener("click", () => {
      button.style.display = "none";

      document.querySelectorAll<HTMLVideoElement>(".product-video").forEach((video) => {
        video.controls = true;
        void video.play();
      });
    });
  });

  const stockRequestEmail = document.querySelector<HTMLInputElement>(".js-stock-request-email");
  const stockRequestButtons = document.querySelectorAll<HTMLElement>(".js-stock-request");

  function updateStockRequestVisibility() {
    if (!stockRequestEmail) {
      return;
    }

    stockRequestButtons.forEach((button) => {
      setVisible(button, stockRequestEmail.value.trim().length > 0);
    });
  }

  updateStockRequestVisibility();
  stockRequestEmail?.addEventListener("keyup", updateStockRequestVisibility);

  stockRequestButtons.forEach((button) => {
    button.addEventListener("click", async () => {
      if (!stockRequestEmail) {
        return;
      }

      const parameters = {
        itemId: button.dataset.itemId,
        email: stockRequestEmail.value,
      };

      setVisible(button, false);
      setVisible(stockRequestEmail, false);
      document
        .querySelectorAll<HTMLElement>(".js-stock-request-confirmation")
        .forEach((message) => {
          setVisible(message, true);
        });

      if (!window.AJAX) {
        throw new Error("The stock request handler is not available.");
      }

      await window.AJAX("ecommerce-stock-request", parameters, "none");
    });
  });

  document.querySelectorAll<HTMLElement>(".faq-question").forEach((question) => {
    question.addEventListener("click", () => {
      const questionBox = question.parentElement;
      const answer = questionBox?.querySelector<HTMLElement>(".faq-answer");
      const paragraph = answer?.querySelector("p");

      if (!questionBox || !answer || !paragraph) {
        return;
      }

      const paragraphStyle = getComputedStyle(paragraph);
      const contentHeight =
        paragraph.getBoundingClientRect().height -
        parseFloat(paragraphStyle.paddingTop) -
        parseFloat(paragraphStyle.paddingBottom) -
        parseFloat(paragraphStyle.borderTopWidth) -
        parseFloat(paragraphStyle.borderBottomWidth);

      answer.style.setProperty("--_this-max-height", `${contentHeight}px`);

      document.querySelectorAll(".faq-element").forEach((element) => {
        if (element !== questionBox) {
          element.classList.remove("active");
        }
      });

      questionBox.classList.toggle("active");
    });
  });

  document.querySelectorAll<HTMLElement>(".reviews-arrow").forEach((arrow) => {
    arrow.addEventListener("click", () => {
      const carousel = document.querySelector<HTMLElement>(".reviews-carousel");
      const reviewCount = document.querySelectorAll(".review").length;

      if (!carousel || reviewCount === 0) {
        return;
      }

      const direction = arrow.dataset.direction;
      let position = Number(carousel.dataset.pos);

      position = direction === "left" ? position - 1 : position + 1;

      if (position < 1) {
        position = reviewCount;
      } else if (position > reviewCount) {
        position = 1;
      }

      carousel.style.setProperty("--_pos", String(position));
      carousel.dataset.pos = String(position);
    });
  });

  document.querySelectorAll<HTMLElement>(".review-star_post").forEach((star) => {
    star.addEventListener("mouseenter", () => {
      star.classList.add("active");

      let previousStar = star.previousElementSibling;
      while (previousStar) {
        previousStar.classList.add("active");
        previousStar = previousStar.previousElementSibling;
      }
    });

    star.addEventListener("mouseleave", () => {
      document.querySelectorAll(".review-star_post").forEach((item) => {
        item.classList.remove("active");
      });
    });

    star.addEventListener("click", () => {
      document.querySelectorAll<HTMLButtonElement>(".post-review button").forEach((button) => {
        button.disabled = false;
      });
    });
  });

  document.querySelectorAll<HTMLElement>(".review-stars_post").forEach((stars) => {
    stars.addEventListener("mouseleave", () => {
      const checkedStar = document.querySelector<HTMLInputElement>(".post-review-cbx:checked");
      let previousStar = checkedStar?.previousElementSibling;

      while (previousStar) {
        previousStar.classList.add("active");
        previousStar = previousStar.previousElementSibling;
      }
    });
  });

  document.querySelectorAll<HTMLElement>(".gift-value").forEach((value) => {
    value.addEventListener("click", () => {
      const price = Number.parseFloat(value.dataset.price ?? "");

      if (!Number.isFinite(price)) {
        return;
      }

      const priceString = `R$ ${price.toFixed(2).replace(".", ",")}`;
      const installments = `ou 2x R$ ${(price / 2).toFixed(2).replace(".", ",")}`;

      document.querySelectorAll(".gift-value").forEach((item) => {
        item.classList.remove("active");
      });

      value.classList.add("active");

      const giftPrice = document.querySelector<HTMLInputElement>('[name="gift-price"]');
      if (giftPrice) {
        giftPrice.value = String(price);
      }

      document.querySelectorAll<HTMLElement>(".product-price-full").forEach((element) => {
        element.textContent = priceString;
      });

      document.querySelectorAll<HTMLElement>(".product-price-installments").forEach((element) => {
        element.textContent = installments;
      });
    });
  });

  document.querySelectorAll<HTMLElement>(".gift-type").forEach((giftType) => {
    giftType.addEventListener("click", () => {
      const type = giftType.dataset.type;

      document.querySelectorAll(".gift-type").forEach((item) => {
        item.classList.remove("active");
      });

      giftType.classList.add("active");

      const giftTypeInput = document.querySelector<HTMLInputElement>('[name="gift-type"]');
      if (giftTypeInput && type) {
        giftTypeInput.value = type;
      }

      const giftForm = document.querySelector<HTMLElement>(".gift-form");
      const form = giftType.closest("form");

      if (type === "1") {
        if (giftForm) {
          setVisible(giftForm, true);
        }
        form?.removeAttribute("novalidate");
      } else {
        if (giftForm) {
          setVisible(giftForm, false);
        }
        form?.setAttribute("novalidate", "");
      }
    });
  });
}

if (document.readyState === "complete") {
  initializeProductPage();
} else {
  document.addEventListener("DOMContentLoaded", initializeProductPage, { once: true });
}
