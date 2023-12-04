progressShipping = $("ul li:first-of-type");
progresspayment = $("ul li:last-of-type");
shippingForm = $("#shipping");
confirmshippingBtn = $("#next");
paymentForm = $("#payment");
reviseShippingBtn = $("#revise");
confirmPaymentBtn = $("#done");
thankYou = $("#thankyou");
redoBtn = $("#thankyou button");

// To start, the 'shipping' part of the progress bar is active (green)
progressShipping.addClass("active");



// when we click the revise shipping button, the payment form shrinks, fades, and has no display. The first form comes in from the left. the progress bar is altered
reviseShippingBtn.click(function (e) {
  e.preventDefault();
  paymentForm.hide();
  shippingForm.show();
  shippingForm.addClass("slide-in-left");
  progresspayment.removeClass("active");
  setTimeout(() => {
    paymentForm.removeClass("scale-out");
    shippingForm.removeClass("slide-in-left");
  }, 510);
});

// when we click the confirm payment button,

confirmPaymentBtn.click(function (e) {
  e.preventDefault();
  paymentForm.hide();
  thankYou.show();
  thankYou.addClass("slide-up");
  setTimeout(() => {
    redoBtn.show();
    redoBtn.addClass("appear");
    thankYou.removeClass("slide-up");
  }, 1000);
  setTimeout(() => {
    redoBtn.removeClass("appear");
  }, 2000);
});

redoBtn.click(function (e) {
  e.preventDefault();
  thankYou.hide();
  redoBtn.hide();
  progresspayment.removeClass("active");
  shippingForm.show();
});