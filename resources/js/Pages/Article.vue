<script setup>
import NavLink from "@/Components/NavLink.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { defineProps } from "vue";
defineProps(["articles"]);
</script>

<template>
  <AuthenticatedLayout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Bienvenu sur le composant article
    </h2>
    <NavLink
      :href="route('article.create')"
      class="bg-blue-500 text-white p-2 rounded-lg text-xl hover:bg-indigo-500"
    >
      Créer un article
    </NavLink>

    <p>Affichage des articles</p>
  

    <div v-for="article in articles" :key="article.id" :article="article">
      {{ article.body }}
    </div>
    <!-- <div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="col">
        <div class="card">
          <img
            src="../Pages/images/pexels-cottonbro-4325436.jpg"
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-Title of article">Title of article</h5>
            <p class="card-text">
              This is a longer card with supporting text below as a natural
              lead-in to additional content. This content is a little bit
              longer.
            </p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img
            src="../Pages//images/pexels-cottonbro-5097276.jpg"
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-Title of article">Title of article</h5>
            <p class="card-text">
              This is a longer card with supporting text below as a natural
              lead-in to additional content. This content is a little bit
              longer.
            </p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img
            src="../Pages/images/pexels-cottonbro-4325442.jpg"
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-Title of article">Title of article</h5>
            <p class="card-text">
              This is a longer card with supporting text below as a natural
              lead-in to additional content.
            </p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img
            src="../Pages/images/pexels-cottonbro-4829061.jpg"
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-Title of article">Title of article</h5>
            <p class="card-text">
              This is a longer card with supporting text below as a natural
              lead-in to additional content. This content is a little bit
              longer.
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 g-4">
      <div class="col">
        <div class="card">
          <img
            src="../Pages/images/pexels-han-s-culture-426014270-27135842.jpg"
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-Title of article">Title of article</h5>
            <p class="card-text">
              This is a longer card with supporting text below as a natural
              lead-in to additional content. This content is a little bit
              longer.
            </p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img
            src="../Pages/images/pexels-diimejii-9559669.jpg"
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-Title of article">Title of article</h5>
            <p class="card-text">
              This is a longer card with supporting text below as a natural
              lead-in to additional content. This content is a little bit
              longer.
            </p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img
            src="../Pages/images/pexels-divinetechygirl-1181271.jpg"
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-Title of article">Title of article</h5>
            <p class="card-text">
              This is a longer card with supporting text below as a natural
              lead-in to additional content.
            </p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img
            src="../Pages/images/pexels-enric-cruz-lopez-6039209.jpg"
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-Title of article">Title of article</h5>
            <p class="card-text">
              This is a longer card with supporting text below as a natural
              lead-in to additional content. This content is a little bit
              longer.
            </p>
          </div>
        </div>
      </div>
    </div> -->
  </AuthenticatedLayout>
</template>



