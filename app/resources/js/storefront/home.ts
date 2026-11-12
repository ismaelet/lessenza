document.addEventListener("DOMContentLoaded", function () {
  const reviewSelector = ".js-review";
  const reviews = document.querySelectorAll(reviewSelector);
  const reviewCount = reviews.length;

  let activeReviewKey = 1;

  window.setInterval(cycle_reviews, 10000);

  function cycle_reviews() {
    activeReviewKey++;

    if (activeReviewKey > reviewCount) {
      activeReviewKey = 1;
    }

    reviews.forEach((element) => {
      element.classList.remove("active");
    });

    document
      .querySelector(reviewSelector + ":nth-child(" + activeReviewKey + ")")
      .classList.add("active");
  }
});
