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

  <div class="bg-gray-800">
    <div class="relative flex h-16 items-center justify-between">
      <div >
        <div class="hidden sm:ml-6 sm:block">
          <header  >
            <div class="flex space-x-4">
              <nav v-if="canLogin" >
                <Link
                  v-if="$page.props.auth.user"
                  :href="route('dashboard')"
                  class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white"
                  aria-current="page"
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
                          class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white "
                          style="color: white; box-shadow: 50px;"
                        >
                          Se connecter
                        </Link>
                      </li>
                      <li class="nav-item">
                        <Link
                          v-if="canRegister"
                          :href="route('register')"
                          id="login"
                          class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                          style="color: white; box-shadow: 50px"
                        >
                          Créer un compte
                        </Link>
                      </li>
                    </ul>
                  </div>
                </template>
              </nav>
            </div>
          </header>
        </div>
      </div>
    </div>
  </div>
</template>


<!-- <style scoped>
div {
  margin: auto;
  background: rgb(109, 109, 110);
  display: flex;
  padding: 3.5px;
  /* margin-top: 1px; */
  /* height: 50px; */

}
</style> -->




      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->


