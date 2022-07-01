<script setup>
    import Card from "@/Components/Card/Card.vue";
    import Label from "@/Components/Label.vue";
    import Input from "@/Components/Input.vue";
</script>

<template>
    <Card class="mb-4">
        <template #header> 
            Filters
        </template>
        <form class="grid grid-cols-4 gap-8">
            <div>
                <Label value="Name" />
                <Input type="text" class="mt-1 block w-full" v-model="filters.name" />
            </div>
        </form>
    </Card>
</template>
