let paymentMethode=document.querySelector(".payment-method");
let card=document.querySelector(".card-payment-form");
let mobileBanking=document.querySelector(".mobile-banking-form");
let bakTransfer=document.querySelector(".bank-transfer-form");
let mbBankmethod=document.querySelector(".paymentMethodMb");
let mbBankmethodpara=document.querySelector(".mb-method");

card.style.display="block";
mobileBanking.style.display="none";
bakTransfer.style.display="none";

paymentMethode.addEventListener("change",function(){
    card.style.display="none";
    mobileBanking.style.display="none";
    bakTransfer.style.display="none";
    mbBankmethod.style.display="none";
    mbBankmethodpara.style.display="none";
    
        if(paymentMethode.value==="debit-card" || paymentMethode.value==="credit-card"){
            card.style.display="block";
        }else if(paymentMethode.value==="mobile-banking"){
            mobileBanking.style.display="block";
            mbBankmethod.style.display="block";
            mbBankmethodpara.style.display="block";
        }else if(paymentMethode.value==="bank-transfer"){
            bakTransfer.style.display="block";
        }else{
            card.style.display="block";
            mobileBanking.style.display="none";
            bakTransfer.style.display="none";
        }
    });

    document.querySelectorAll('.rating').forEach(select => {
        select.addEventListener('change', function () {
          alert(`Thanks for rating: ${this.value} star(s)`);
        });
      });
// paid status update
let paymentbtn=document.querySelector(".submit-payment-btn");
let amountDetails=document.querySelector(".amount-details");
paymentbtn.addEventListener("click",function(){
    alert("Payment Successful!");
    amountDetails.innerHTML=`<h3>Payment Details</h3>
          <p><strong>Amount:</strong> $50</p>
          <p><strong>Status:</strong> Paid ✅</p>`
});

// page update
let current1=document.querySelector(".current");
let past1=document.querySelector(".past");
let pastHistory=document.querySelector(".history");
let currentHistory=document.querySelector(".curStatusDetail");

pastHistory.style.display="none";
    currentHistory.style.display="grid";

current1.addEventListener("click",function(){
    pastHistory.style.display="none";
    currentHistory.style.display="grid";
});

past1.addEventListener("click",function(){
    pastHistory.style.display="block";
    currentHistory.style.display="none";
});