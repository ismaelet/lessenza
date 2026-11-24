document.addEventListener("DOMContentLoaded", () => {
  const reviews = document.querySelectorAll(".js-review");

  if (reviews.length > 0) {
    let activeReviewKey = 1;

    window.setInterval(() => {
      activeReviewKey = activeReviewKey >= reviews.length ? 1 : activeReviewKey + 1;

      reviews.forEach((review) => review.classList.remove("active"));
      reviews[activeReviewKey - 1].classList.add("active");
    }, 10000);
  }
});

// Rotate one card at a time, keeping each slot's products distinct.
document.querySelectorAll<HTMLElement>(".home-oils__cards").forEach((cards) => {
  const slots = [...cards.querySelectorAll<HTMLElement>(".home-oils__slot")];
  const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)");
  let nextSlot = 0;

  const timer = window.setInterval(() => {
    if (
      reducedMotion.matches ||
      document.hidden ||
      cards.matches(":hover") ||
      cards.contains(document.activeElement)
    ) {
      return;
    }

    const products = [...slots[nextSlot].querySelectorAll<HTMLElement>(".home-oils__card")];
    const current = products.findIndex((product) => !product.hidden);
    if (products.length > 1) {
      products[current].hidden = true;
      products[(current + 1) % products.length].hidden = false;
    }
    nextSlot = (nextSlot + 1) % slots.length;
  }, 2000);

  window.addEventListener("pagehide", () => window.clearInterval(timer), { once: true });
});
