import { capitalize } from 'vue';
import { DateTime } from 'luxon';

export default () => {
    const toLocaleDateTimeString = (date) => {
        return capitalize(DateTime.fromISO(date).setLocale('pt-BR').toFormat('EEE dd LLLL yyyy'));
    };

    const formatDate = (date) => {
        return DateTime.fromISO(date).toFormat('dd/MM/yyyy');
    };

    return {
        toLocaleDateTimeString,
        formatDate,
    };
};
