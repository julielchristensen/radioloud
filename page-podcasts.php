<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */
get_header();
?>

<style>
    img {
        cursor: pointer;
    }

    /**/
    .billede {
        opacity: 1;
        display: block;
        transition: .5s ease;
        backface-visibility: hidden;
    }

    /*sat hover på billedet så det mister opacity når man holder musen henover*/
    .billede:hover {
        opacity: 0.3;
    }

    #liste {
        margin-top: 2rem;
    }


    #podcast-oversigt {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        grid-gap: 20px;
        padding-bottom: 2rem;
        margin: 2rem;
    }

    #top {
        margin-top: 6rem;
        /*
        display: grid;
        grid-template-columns: 2fr 1fr;
*/
    }

    .tekst {
        background-color: #FFF8E4;
        padding: 2rem;
    }

    .gif {
        position: absolute;
        left: 144px;
        top: 79px;
        width: 23%;
    }


    .logobillede {
        width: 60%;
    }


    h2 {
        font-size: 50px;
    }


    h3 {
        font-size: 18px;
        padding-top: 1rem;
        font-weight: 700;
    }


    p {
        font-size: 17px;
    }

    button {
        margin: 5px;
        border-radius: 50px;
        text-align: center;
        cursor: pointer;
        background-color: white;
        box-sizing: border-box;
        padding: 1em 2rem;
        border-color: #013B48;
        border-style: double;
        transition-duration: 0, 4s;
        display: inline-block;
        color: black;
    }

    .filter:hover {
        background-color: #DFEAE2;
    }



    #filtrering {
        padding-left: 2rem;
        padding-bottom: 2rem;
        overflow: auto;
        white-space: nowrap;
    }

    filter:active {
        background-color: #DFEAE2;
    }

    /*
    .filter {
    display: inline-block;
    color: black;
    text-align: center;
    }
*/

    .hoejre {
        position: relative;
    }

    .et_fullwidth_nav #main-header .container {
        background-color: white;
    }

    @media (min-width: 700px) {

        #filtrering {
            text-align: center;
        }

        .gif {
            left: 189px;
            top: 94px;
        }


        button {
            margin: 20px;
            padding: 1em 3rem;
        }

        main#main {
            margin: 0 3.5rem;
        }

        #filtrering {
            margin-bottom: 2rem;
        }

        #top {
            display: grid;
            grid-template-columns: 2fr 1fr;
        }

        .tekst {
            padding: 4rem;
        }

        .banner {
            width: 100%;
            height: 100%;
        }


    }

</style>

<section id="top">
    <div class="tekst">
        <h2>Podcast</h2>
        <p>Herunder har vi samlet alle vores podcasts, så du nemt kan finde frem til lige præcis den, du gerne vil høre. Hvis du vil høre mere om hver enkel podcast kan du klikke ind på den enkelte og læse mere.</p>
        <p>Du kan lytte til alle vores podcasts på: Spotify, Google Podcasts, Podimo og Apple Podcasts.</p>
    </div>
    <div class="hoejre">
        <img src="/radioloud/wp-content/themes/child/images/bannerimg.png" class="banner" alt="">
        <div class="giff">
            <img src="/radioloud/wp-content/themes/child/images/gifmaker.gif" class="gif" alt="">
        </div>
    </div>

</section>

<section id="liste">
    <template>
        <article class="podcast">
            <img src="" alt="" class="billede">
            <h3 class="navn">
            </h3>
        </article>
    </template>
</section>

<section id="primary" class="content-area">

    <main id="main" class="site-main">
        <nav id="filtrering"></nav>
        <section id="podcast-oversigt"> </section>
    </main>

    <script>
        let podcasts;
        let categories;
        let filterPodcast = "alle";

        const url = "https://julielykkechristensen.dk/radioloud/wp-json/wp/v2/podcast?per_page=100";
        const catUrl = "https://julielykkechristensen.dk/radioloud/wp-json/wp/v2/categories";


        async function getJson() {
            let data = await fetch(url);
            let catdata = await fetch(catUrl);
            podcasts = await data.json();
            categories = await catdata.json();
            console.log(categories);
            visPodcasts();
            opretKnapper();
        }

        function opretKnapper() {
            categories.forEach(cat => {
                document.querySelector("#filtrering").innerHTML += `<button class="filter" data-podcast="${cat.id}">${cat.name}</button>`
            })

            addEventListenerToButtons();

        }

        function addEventListenerToButtons() {
            document.querySelectorAll("#filtrering button").forEach(elm => {
                elm.addEventListener("click", filtrering);
            })
        }

        function filtrering() {
            filterPodcast = this.dataset.podcast;
            console.log(filterPodcast);

            visPodcasts();

        }

        function visPodcasts() {

            console.log(podcasts);
            let temp = document.querySelector("template");
            let container = document.querySelector("#podcast-oversigt");
            container.innerHTML = "";
            podcasts.forEach(podcast => {
                if (filterPodcast == "alle" || podcast.categories.includes(parseInt(filterPodcast))) {
                    let klon = temp.cloneNode(true).content;
                    klon.querySelector(".navn").textContent = podcast.title.rendered;
                    klon.querySelector(".billede").src = podcast.billede.guid;
                    klon.querySelector("article").addEventListener("click", () => {
                        location.href = podcast.link;
                    })
                    container.appendChild(klon);
                }

            })
        }

        getJson();
        //
        //             klon.querySelector("article").addEventListener("click", ()=> {location.href = drink.link; })
        //                    container.appendChild(klon);

    </script>
</section>

<?php
get_footer();
