<template>
  <div class="flex items-center">
    <!-- Settings Dropdown -->
    <div class="relative">
      <Dropdown
        align="right"
        width="48"
      >
        <template #trigger>
          <span class="inline-flex rounded-md">
            <button
              type="button"
              class="inline-flex justify-center relative items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
            > 
              <span
                class="w-6 h-6 overflow-hidden text-white shadow rounded-full bg-transparent focus:bg-white"
                :title="currentUser?.name ?? 'user'"
              >
                <IUser />
              </span>
            </button>
          </span>
        </template>

        <template #content>
          <DropdownLink
            v-if="isAdmin"
            :href="route('admin.index')"
          >
            Admin
          </DropdownLink>

          <DropdownLink
            v-if="currentUser"
            :href="route('orders.index')"
          >
            Orders
          </DropdownLink>

          <DropdownLink
            :href="route('products.index')"
          >
            Messages
          </DropdownLink>
          <DropdownLink :href="route('products.index')">
            Notification
          </DropdownLink>
          <DropdownLink :href="route('profile.edit')">
            Profile
          </DropdownLink>
          <DropdownLink
            :href="route('logout')"
            method="post"
            as="button"
            v-if="currentUser"
          >
            <div class="flex flex-row items-center">
              <span class="inline-flex justify-center items-center mr-2 text-red-400">
                <svg
                  class="w-5 h-5"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                ><path
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                /></svg>
              </span>
              Log out
            </div>
          </DropdownLink>
          <template v-if="!currentUser">
          <DropdownLink
            :href="route('login')"
          >
            Login
          </DropdownLink>
          <DropdownLink
            :href="route('register')"
          >
            Register
          </DropdownLink>
          </template>
        </template>
      </Dropdown>
    </div>
  </div>
</template>

<script setup lang="ts">
import {computed, inject} from 'vue'
import {usePage} from "@inertiajs/vue3";
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import IUser from "@/Components/Icons/IUser.vue";
import IChevron from "@/Components/Icons/IChevron.vue";

interface User {
  name: string
}

interface Auth {
  can: object
}

const auth = computed(() => usePage().props.auth );
const currentUser = computed<User>(() => auth.value.user)
const isAdmin = computed<Auth>(() => auth.value?.can?.admin ?? null)
const route = inject('route');
</script>

