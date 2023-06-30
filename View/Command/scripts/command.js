// const ratings = document.querySelectorAll('.product-rating .star');
const product_ratings = document.querySelectorAll('.product-rating');
const seller_ratings = document.querySelectorAll('.seller-rating');

const ratings = [product_ratings, seller_ratings];

ratings.forEach(function(rating, index) {
    for(let i = 0; i < rating.length; i++) {
        let id = rating[i].dataset.id;
    
        for(let j = 0; j < rating[i].children.length; j++) {
            rating[i].children[j].addEventListener("click", function() {
                for(let k = 0; k < rating[i].children.length; k++) {
                    if(k <= j) {
                        rating[i].children[k].classList.remove('far');
                        rating[i].children[k].classList.add('fas');
                    } else {
                        rating[i].children[k].classList.remove('fas');
                        rating[i].children[k].classList.add('far');
                    }
                }

                let uri = index === 0 ? "/products/" : "/user/";

                (async () => {
                    const response = await fetch(uri + id + "/rate", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            rating: j + 1
                        })
                    });

                    if(response.status === 403) {
                        window.location.href = "/login";
                    }
                    
                    const data = await response.json();
                    
                    if(!data.success) {
                        console.error(data);
                    }
                })();
            });
        }
    }   

});