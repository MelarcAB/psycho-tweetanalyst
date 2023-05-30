//jquery on load
$(function () {

    var b_search = $('#b-search');
    var input_search = $('#input-search');
    var spinner = $('#spinner');

    var app = $('#app');
    var tweets_container = $('#tweets-container');
    var gpt_container = $('#gpt-container');
    init();


    b_search.on('click', searchUser);


    function init() {
        spinner.hide();
    }

    function searchUser() {
        let user = input_search.val();
        if (user != '') {
            spinner.show();
            let url = `/tweets/${user}`;
            //axios
            axios.get(url)
                .then(function (response) {
                    console.log(response.data);
                    //data es un array, recorrerlo
                    let tweets = response.data.tweets;
                    let html = '';
                    tweets.forEach(tweet => {
                        html += generateTweetHTML(tweet.username, tweet.message, tweet.date, tweet.tweetId, tweet.image);
                        tweets_container.html(html);

                    });
                    spinner.hide();
                    generateAnalisis(response.data.tweets_msg)

                })
                .catch(function (error) {
                    console.log(error);
                    spinner.hide();
                }
                );
        }
    }

    function generateAnalisis(tweets) {
        console.log("Generando analisis...")
        let url = `/gpt`;
        spinner.show();
        //axios post
        axios.post(url, {
            tweets: tweets
        })
            .then(function (response) {
                console.log(response.data);
                console.log(response.data.choices[0].message.content);
                spinner.hide();
                let html = generateAnalisisHTML(response.data.choices[0].message.content);
                gpt_container.html(html);
            }
            )
            .catch(function (error) {
                console.log(error);
                spinner.hide();
            }
            );
    }


    function generateTweetHTML(username, text, date, tweetId, image) {
        return `
          <div class="bg-white rounded-lg shadow-lg p-6 m-3">
            <div class="flex items-center mb-4">
              <img src="${image}" alt="Profile Image" class="h-8 w-8 rounded-full mr-2">
              <span class="text-gray-700 font-semibold">${username}</span>
            </div>
            <p class="text-gray-800 mb-4">${text}</p>
            <div class="flex justify-between text-gray-600 text-sm">
              <span>${date}</span>
              <span>${tweetId}</span>
            </div>
          </div>
        `;
    }

    function generateAnalisisHTML(analisis) {
        return `
        <div class="bg-white rounded-lg shadow-lg p-6 m-3">
            <div class="flex items-center mb-4">${analisis}
            </div>
        </div>
      `;

    }


});
