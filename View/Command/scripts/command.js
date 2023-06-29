// const ratings = document.querySelectorAll('.product-rating .star');
const ratings = document.querySelectorAll('.product-rating');

for(let i = 0; i < ratings.length; i++) {
    let product_id = ratings[i].dataset.id;

    for(let j = 0; j < ratings[i].children.length; j++) {
        ratings[i].children[j].addEventListener("click", function() {
            for(let k = 0; k < ratings[i].children.length; k++) {
                if(k <= j) {
                    ratings[i].children[k].classList.remove('far');
                    ratings[i].children[k].classList.add('fas');
                } else {
                    ratings[i].children[k].classList.remove('fas');
                    ratings[i].children[k].classList.add('far');
                }
            }

            (async () => {
                const response = await fetch("/products/" + product_id + "/rate", {
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