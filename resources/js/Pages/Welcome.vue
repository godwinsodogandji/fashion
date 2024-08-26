<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },
});

function handleImageError() {
  document.getElementById("screenshot-container")?.classList.add("!hidden");
  document.getElementById("docs-card")?.classList.add("!row-span-1");
  document.getElementById("docs-card-content")?.classList.add("!flex-row");
  document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
  <Head title="Welcome" />

  <div>
    <div>
      <div>
        <header>
          <nav v-if="canLogin">
            <Link
              v-if="$page.props.auth.user"
              :href="route('dashboard')"

            >
              Dashboard
            </Link>

            <template v-else>
              <div class="  ">
                <ul class="nav nav-pills">
                  <li class="nav-item">
                    <Link
                      :href="route('login')"
                      id="login"
                      class="nav-link"
                      style="color: black; box-shadow: 50px"
                    >
                      Se connecter
                    </Link>
                  </li>
                  <li class="nav-item">
                    <Link
                      v-if="canRegister"
                      :href="route('register')"
                      id="login"
                      class="nav-link"
                      style="color: black; box-shadow: 50px"
                    >
                      Créer un compte
                    </Link>
                  </li>
                </ul>
              </div>
            </template>
          </nav>
        </header>
      </div>
    </div>
  </div>
</template>


<style scoped>
div {
  margin: auto;
  background: rgb(245, 241, 241);
  display: flex;
  padding: 3.5px;
  /* margin-top: 1px; */
  /* height: 50px; */

}
</style>


