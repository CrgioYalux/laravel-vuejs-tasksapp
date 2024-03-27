<script>
    export default {
        name: 'TasksForm'
    }
</script>

<script setup>
import FormSection from '@/Components/FormSection.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

const props = defineProps({ // vertical descendent communication
    form: {
        type: Object,
        required: true,
    },
    updating: {
        type: Boolean,
        required: false,
        default: false,
    },
    users: {
        type: Array,
        required: true,
        default: []
    }
})

defineEmits([ // vertical ascendent communication
    'submit',
])

</script>

<template>
    <FormSection @submitted="$emit('submit')">
        <template #title>
            {{ updating ? 'Update Task' : 'Create Task' }}
        </template>
        <template #description>
            {{ updating ? 'Update the current task' : 'Assign a new task' }}
        </template>
        <template #form>
            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="title" value="Title" />
                <TextInput id="title" v-model="form.title" type="text" autocomplete="title" class="mt-1 block w-full" />
                <InputError :message="$page.props.errors.title" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="body" value="Body" />
                <TextInput id="body" v-model="form.body" type="text" autocomplete="body" class="mt-1 block w-full" />
                <InputError :message="$page.props.errors.body" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="assigned_to_user_id" value="User" />
                <select v-model="form.assigned_to_user_id">
                    <option
                    v-for="user in users"
                    :key="user.id"
                    :value="user.id"
                    >
                        {{ user.name }}
                    </option>
                </select>
                <InputError :message="$page.props.errors.assigned_to_user_id" class="mt-2" />
            </div>
        </template>
        <template #actions>
            <PrimaryButton>
                {{ updating ? 'Update' : 'Create' }}
            </PrimaryButton>
        </template>
    </FormSection>
</template>
