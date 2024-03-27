<script>
    export default {
        name: 'TasksCreate'
    }
</script>

<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import TaskForm from '@/Components/Tasks/Form.vue'

const props = defineProps({
    created_by_user_id: {
        type: Number,
        required: true,
        default: 0
    },
    users: {
        type: Array,
        required: true,
        default: []
    }
})

const form = useForm({
    title: '',
    body: '',
    assigned_to_user_id: 0,
    created_by_user_id: props.created_by_user_id,
})

</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" v-if="$page.props.user.roles.includes('super admin')">
                Create New Task
            </h2>
        </template>
        {{ $page.user }}
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class='bg-white overflow-hidden shadow-sm sm:rounded-lg'>
                    <div class='bg-white overflow-hidden shadow-xl sm:rounded-lg'>
                        <div class='p-6 bg-white border-b border-gray-200'>
                            <TaskForm :form="form" :users="props.users" @submit="form.post(route('tasks.store'))" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
