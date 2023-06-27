const ratings = document.querySelectorAll('.ratings .star');

for(let i = 0; i < ratings.length; i++){
    ratings[i].addEventListener('click', function() {
        for(let j = 0; j < ratings.length; j++) {
            if(j <= i) {
                ratings[j].classList.remove('far');
                ratings[j].classList.add('fas');
            } else {
                ratings[j].classList.remove('fas');
                ratings[j].classList.add('far');
            }
        }

        (async () => {
            const response = await fetch("/products/" + window.location.pathname.split("/")[2] + "/rate", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    rating: i + 1
                })
            });

            if(response.status === 403) {
                window.location.href = "/login";
            }
            
            const data = await response.json();
            
            if(data.success) {
                console.log("Success");
            } else {
                console.error(data);
            }
        })();
    });
}