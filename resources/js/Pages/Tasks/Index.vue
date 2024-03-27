<script>
    export default {
        name: 'TasksIndex'
    }
</script>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link, router } from '@inertiajs/vue3'

    const props = defineProps({
        tasks: {
            type: Array,
            required: true,
            default: []
        },
        statuses: {
            type: Array,
            required: true,
            default: []
        },
    })

    const deleteTask = (id) => {
        if (confirm('Are you sure?')) {
            router.delete(route('tasks.delete'), id)
        }
    }

    const pushState = (taskId, statusId) => {
        const push = { post_task_id: taskId, status_id: statusId }
        const status = props.statuses.find(v => v.id === push.status_id)

        if(!!status && confirm(`Are you sure you want to mark the task as '${status.title}'?`)) {
            router.post(route('task_statuses.store'), push)
        }
    }

    const isChecked = (taskStatusId, statusId) => taskStatusId === statusId
</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $page.props.user.roles.includes('super admin') ? 'Tasks' : 'My Tasks' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                class="p-6 bg-white border-b border-gray-200"
                >
                    <div
                        class="flex justify-between"
                        v-if="$page.props.user.roles.includes('super admin')"
                    >
                        <Link
                        :href="route('tasks.create')"
                        class="text-gray-100 bg-indigo-500 px-2 py-1 hover:bg-indigo-700 rounded">
                            Create Task
                        </Link>
                    </div>
                    <div
                        class="flex justify-between"
                        v-if="$page.props.user.roles.includes('employee')"
                    >
                        <h3 class="text-xl text-gray-950">
                            Currently Working On
                        </h3>
                    </div>
                    <div class="mt-4">
                        <ul role="list" class="divide-y divide-gray-200">
                            <li
                                class="flex justify-between gap-x-6 py-5 first:border-t border-gray-200"
                                v-for="task in tasks"
                            >
                                <div
                                    class="flex min-w-0 gap-x-4"
                                    v-if="$page.props.user.roles.includes('super admin')"
                                >
                                    <div class="min-w-0 flex-auto flex flex-col gap-y-2 items-center justify-center">
                                        <Link
                                        :href="route('tasks.edit', task.id)"
                                        class="w-full border-2 text-indigo-500 border-current rounded-full px-2 text-center"
                                        >Edit</Link>
                                        <Link
                                        :href="_blank"
                                        @click="deleteTask(task.id)"
                                        class="w-full border-2 text-red-500 border-current rounded-full px-2 text-center"
                                        >Delete</Link>
                                    </div>
                                </div>
                                <div class="flex min-w-0 gap-x-4 mr-auto">
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-xs leading-6 text-gray-600">
                                            Task ID: {{ task.id }}
                                        </p>
                                        <p class="text-md font-bold leading-6 text-gray-900">
                                            {{ task.title }}
                                        </p>
                                        <p class="mt-1 truncate text-xs leading-4 text-gray-500 max-w-[20ch]">
                                            {{ task.body }}
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="flex flex-col shrink-0 sm:items-end justify-between gap-4"
                                >
                                    <p
                                        class="text-sm text-gray-900"
                                        v-if="$page.props.user.roles.includes('super admin')"
                                    >
                                        Assigned to: {{ task.user_name }}
                                    </p>
                                    <p class="text-xs text-gray-600">
                                        Last updated
                                        <time datetime="2023-01-23T13:23Z">
                                            {{ new Date(task.updated_at).toLocaleString() }}
                                        </time>
                                    </p>
                                    <div class="flex w-full items-center gap-2">
                                        <p class="text-md text-gray-600">Push state:</p>
                                        <div class="flex gap-2 items-center">
                                            <Link
                                            v-for="status in statuses"
                                            :key="status.id"
                                            class="opacity-80 hover:opacity-100 cursor-pointer text-indigo-500 border-2 border-current px-2 rounded last:text-red-500 font-semibold"
                                            :class="{ 'hidden': task.status_id === status.id }"
                                            @click="pushState(task.id, status.id)"
                                            >
                                                {{ status.title }}
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
