<script>
    export default {
        name: 'UsersIndex'
    }
</script>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link } from '@inertiajs/vue3'

    defineProps({
        users: {
            type: Object,
            required: true
        }
    })
</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                class="p-6 bg-white border-b border-gray-200"
                v-if="$page.props.user.roles.includes('super admin')"
                >
                    <div class="flex justify-between">
                        <Link :href="route('tasks.create')" class="text-gray-100 bg-indigo-500 px-2 py-1 hover:bg-indigo-700 rounded">
                            Create User
                        </Link>
                    </div>
                    <div class="mt-4">
                        <ul role="list" class="divide-y divide-gray-100">
                            <li class="flex justify-between gap-x-6 py-5" v-for="user in users.data">
                                <div class="flex min-w-0 gap-x-4">
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">{{ user.name }}</p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ user.email }}</p>
                                    </div>
                                </div>
                                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                    <p class="text-sm leading-6 text-gray-900">5 tasks assigned</p>
                                    <p class="mt-1 text-xs leading-5 text-gray-500">Last updated <time datetime="2023-01-23T13:23Z">3h ago</time></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
