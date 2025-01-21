<script setup>
import Modal from '@/Components/Modal.vue';
import useWeek from '@/Composables/useWeek';
import useFormatters from '@/Composables/useFormatters';
import daysOfWeek from '@/Constants/daysOfWeek';

const { resolveEstablishmentDay } = useWeek();
const { phoneFormat, cepFormat } = useFormatters();

const show = defineModel({
    type: Boolean,
    default: false
});

const props = defineProps({
    establishment: {
        type: Object,
        required: true,
    },
});

const currentOperatingHour = (day) => {
    const currentOperationHour = resolveEstablishmentDay(props.establishment.operatingHour, day);

    if (!currentOperationHour) {
        return 'Fechado';
    }

    return `${currentOperationHour.opens_at} - ${currentOperationHour.closes_at}`;
};

</script>

<template>
    <Modal v-model="show">
        <div class="flex flex-col gap-4">
            <div>
                <div class="font-bold">
                    Horários de funcionamento
                </div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <tbody>
                        <tr
                            v-for="(day, index) in daysOfWeek"
                            :key="index"
                            class="odd:bg-white even:bg-gray-50 border-b"
                        >
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ day }}
                            </th>
                            <td class="px-6 py-4">
                                {{ currentOperatingHour(index) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <div class="font-bold">
                    Endereço
                </div>
                <p>
                    {{ establishment.address }}, Nº {{ establishment.number ?? 'S/N' }}, CEP: {{ cepFormat(establishment.cep) }}
                </p>
            </div>
            <div>
                <div class="font-bold">
                    Contato
                </div>
                <p>
                    Telefone: {{ phoneFormat(establishment.phone) }}
                </p>
            </div>
        </div>
    </Modal>
</template>
