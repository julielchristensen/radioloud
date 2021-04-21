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
    button {
        margin-top: 7rem;
        border-radius: 50px;
        text-align: center;
        cursor: pointer;
        background-color: white;
        box-sizing: border-box;
        padding: 1em 3rem;
        border-color: #FFA658;
        border-style: double;
        transition-duration: 0, 4s;
    }

    button:hover {
        background-color: #FFF8E4;
    }

    article {
        display: grid;
        grid-template-columns: 1fr 1fr;
        padding-bottom: 1rem;
        grid-gap: 5px;
    }

    main#main {
        margin: 0 3.5rem;
    }

    .tekst {
        margin-top: 3rem;
    }

    .billede {
        margin-top: 3rem;
        width: 70%;
    }

    h3 {
        font-size: 1rem;
        font-family: 'Open Sans', sans-serif;
        color: black;
    }

    p {
        font-family: 'Open Sans', sans-serif;
        font-size: 0.7rem;
        color: black;
    }

</style>

<section id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="knap">
            <button>Tilbage til podcasts</button>
        </div>

        <article>
            <div>
                <img class="billede" src="" alt="">
            </div>
            <div class="tekst">
                <h3 class="navn">
                </h3>
                <p class="beskrivelse"></p>
            </div>
        </article>

    </main>

    <script>
        let podcast;

        const dbUrl = "https://julielykkechristensen.dk/radioloud/wp-json/wp/v2/podcast/" + <?php echo get_the_ID() ?>;

        async function getJson() {
            const data = await fetch(dbUrl);
            podcast = await data.json();
            visPodcast();
        }

        function visPodcast() {
            console.log("hej med dig");
            document.querySelector(".navn").textContent = podcast.title;
            document.querySelector(".billede").src = podcast.billede.guid;
            document.querySelector(".beskrivelse").textContent = podcast.beskrivelse;
            document.querySelector("button").addEventListener("click", tilbageTilPodcasts);


        }

        function tilbageTilPodcasts() {
            //history = webapi for at komme baglængs, hvis vi kalder back kommer vi et hak tilbage i browserhistorien (dermed tilbage til 01-kald.html)
            history.back();

        }

        getJson();

    </script>

</section>

<?php
get_footer();
