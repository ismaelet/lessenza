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
