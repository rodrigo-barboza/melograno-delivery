<script setup>
import { ref } from 'vue';
import { STATUS } from '@/Constants/orderStatus';
import DatePicker from '@/Components/DatePicker.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SearchInput from '@/Components/SearchInput.vue';
import SelectInput from '@/Components/SelectInput.vue';

const filters = ref({
    orderNumber: null,
    status: 'waiting',
    beginDate: null,
    endDate: null,
});

const statusOptions = Object.entries(STATUS).map(([key, { label }]) => ({ value: key, label }));

</script>

<template>
    <div class="flex gap-2">
        <div class="w-full flex flex-col gap-2">
            <InputLabel
                value="Buscar número do pedido"
                text-size="sm"
            />
            <SearchInput
                v-model="filters.orderNumber"
                class="w-full"
                custom-class="bg-[#FFFFFF] border border-[#CCCCCC]"
                :no-border="false"
            />
        </div>
        <div class="w-full flex flex-col gap-2">
            <InputLabel
                value="Status"
                text-size="sm"
            />
            <SelectInput
                v-model="filters.status"
                class="w-full"
                placeholder="Pendentes"
                :options="statusOptions"
            />
        </div>
        <div class="w-full flex flex-col gap-2">
            <InputLabel
                value="Data inicial"
                text-size="sm"
            />
            <DatePicker
                v-model="filters.beginDate"
                class="w-full"
            />
        </div>
        <div class="w-full flex flex-col gap-2">
            <InputLabel
                value="Data final"
                text-size="sm"
            />
            <DatePicker
                v-model="filters.endDate"
                class="w-full"
            />
        </div>
        <PrimaryButton class="self-end max-w-36">
            Filtrar
        </PrimaryButton>
    </div>
</template>
