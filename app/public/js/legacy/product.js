$(document).ready(function () {
  const productId = $(".js-product-data").data("product-id");

  //images
  $(".product-other-img").click(function () {
    const self = $(this);
    const fileUrl = self.data("src");
    const fileType = self.data("type");

    $(".product-spotlight").removeClass("active");
    $(".product-spotlight.product-" + fileType)
      .attr("src", fileUrl)
      .addClass("active");

    $(".product-other-img").removeClass("active");
    self.addClass("active");
  });

  //video
  $(".play-main-video").click(function () {
    $(this).hide();
    $(".product-video").trigger("play").attr("controls", true);
  });

  // out of stock
  stock_request_filled();

  $(".js-stock-request-email").keyup(function () {
    stock_request_filled();
  });

  function stock_request_filled() {
    if ($(".js-stock-request-email").length) {
      if ($(".js-stock-request-email").val().trim()) {
        $(".js-stock-request").show();
      } else {
        $(".js-stock-request").hide();
      }
    }
  }

  $(".js-stock-request").click(async function () {
    const parameters = {
      itemId: $(this).data("item-id"),
      email: $(".js-stock-request-email").val(),
    };

    $(this).hide();
    $(".js-stock-request-email").hide();
    $(".js-stock-request-confirmation").show();

    await AJAX("ecommerce-stock-request", parameters, "none");
  });

  /*
   * Quantity
   */
  const maxQuantity = $('input[name="quantity"]').attr("max");

  // $(".js-quantity-remove, .js-quantity-add").on("click", function () {
  //     const self = $(this);
  //     const input = $('input[name="quantity"]');

  //     let quantity = input.val();

  //     if (!self.hasClass("disabled")) {
  //         if (self.hasClass("js-quantity-add")) {
  //             quantity++;
  //         } else if (self.hasClass("js-quantity-remove")) {
  //             quantity--;
  //         }
  //     }

  //     update_quantity(quantity);
  // });

  // $('input[name="quantity"]').on("keyup", function () {
  //     const quantity = parseInt($(this).val());

  //     update_quantity(quantity);
  // });

  // function update_quantity(quantity) {
  //     const input = $('input[name="quantity"]');

  //     if (quantity > maxQuantity) {
  //         quantity = maxQuantity;
  //     } else if (quantity < 1) {
  //         quantity = 1;
  //     }

  //     if (quantity > 1) {
  //         $(".js-quantity-remove").removeClass("disabled");
  //     } else if (quantity < maxQuantity) {
  //         $(".js-quantity-add").removeClass("disabled");
  //     }

  //     if (quantity == 1) {
  //         $(".js-quantity-remove").addClass("disabled");
  //     } else if (quantity == maxQuantity) {
  //         $(".js-quantity-add").addClass("disabled");
  //     }

  //     input.val(quantity).trigger("input").trigger("change");
  // }

  // faq
  $(".faq-question").click(function () {
    const questionBox = $(this).parent();
    const answer = questionBox.find(".faq-answer");
    const contentHeight = answer.find("p").height();

    answer.css("--_this-max-height", contentHeight + "px");

    $(".faq-element").not(questionBox).removeClass("active");

    questionBox.toggleClass("active");
  });

  // reviews
  $(".reviews-arrow").click(function () {
    const direction = $(this).data("direction");
    const carousel = $(".reviews-carousel");
    const reviewCount = $(".review").length;

    let pos = carousel.data("pos");

    if (direction == "left") {
      pos--;
    } else {
      pos++;
    }

    if (pos < 1) {
      pos = reviewCount;
    }
    if (pos > reviewCount) {
      pos = 1;
    }

    carousel.css("--_pos", pos).data("pos", pos);
  });

  $(".review-star_post").hover(
    function () {
      $(this).addClass("active");
      $(this).prevAll().addClass("active");
    },
    function () {
      $(".review-star_post").removeClass("active");
    },
  );

  $(".review-stars_post").mouseleave(function () {
    $(".post-review-cbx:checked").prevAll().addClass("active");
  });

  $(".review-star_post").click(function () {
    $(".post-review button").attr("disabled", false);
  });

  /*
   * Gift card
   */
  $(".gift-value").click(function () {
    const self = $(this);
    const price = parseFloat(self.data("price"));
    const priceStr = "R$ " + price.toFixed(2).replace(".", ",");
    const priceInstallments = "ou 2x R$ " + (price / 2).toFixed(2).replace(".", ",");

    $(".gift-value").removeClass("active");
    self.addClass("active");

    $('[name="gift-price"]').val(price);
    $(".product-price-full").text(priceStr);
    $(".product-price-installments").text(priceInstallments);
  });

  $(".gift-type").click(function () {
    const self = $(this);
    const type = self.data("type");

    $(".gift-type").removeClass("active");
    self.addClass("active");

    $('[name="gift-type"]').val(type);

    if (type == 1) {
      $(".gift-form").show();
      self.parents("form").removeAttr("novalidate", "");
    } else {
      $(".gift-form").hide();
      self.parents("form").attr("novalidate", "");
    }
  });
});
