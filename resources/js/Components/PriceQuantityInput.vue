<script setup>
const emit = defineEmits(['change']);

const model = defineModel({
    type: Number,
    required: true,
});

const incrementModelValue = () => (model.value++, emit('change', model.value));

const decrementModelValue = () => {
    if (model.value > 1) {
        model.value--;
    }

    emit('change', model.value);
};

</script>

<template>
    <div class="flex gap-4">
        <div
            class="self-center cursor-pointer flex items-center justify-center w-5 h-5 text-xs font-semibold text-white bg-[#F34444] rounded-full"
            @click="decrementModelValue"
        >
            -
        </div>
        <div class="text-center self-center font-semibold min-w-6">
            {{ model }}
        </div>
        <div
            class="self-center cursor-pointer flex items-center justify-center w-5 h-5 text-xs font-semibold text-white bg-[#F34444] rounded-full"
            @click="incrementModelValue"
        >
            +
        </div>
    </div>
</template>
