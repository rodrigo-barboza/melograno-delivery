import daysOfWeek from '@/Constants/daysOfWeek';
import { DateTime } from 'luxon';

export default () => {
    const today = () => new Date().getDay();
    const now = () => DateTime.local();

    const resolveDayOfWeekText = (day = null) => daysOfWeek[day];

    const resolveEstablishmentDay = (operatingHour, day = null) => {
        const currentDay = day ?? today();

        if (!operatingHour) {
            return null;
        }

        return operatingHour.find((item) => {
            return item.day_of_week === currentDay;
        });
    }

    const isEstablishmentCurrentlyOpen = (operatingHour, day = null) => {
        if (!day) {
            day = today();
        }

        const currentOperationHour = resolveEstablishmentDay(operatingHour, day);

        if (!currentOperationHour) {
            return false;
        }

        const closesAt = currentOperationHour.closes_at === '00:00'
            ? DateTime.fromFormat(currentOperationHour.closes_at, 'HH:mm').plus({ days: 1 })
            : DateTime.fromFormat(currentOperationHour.closes_at, 'HH:mm');

        const opensAt = currentOperationHour.opens_at === '00:00'
            ? DateTime.fromFormat(currentOperationHour.opens_at, 'HH:mm').plus({ days: 1 })
            : DateTime.fromFormat(currentOperationHour.opens_at, 'HH:mm');

        return now() >= opensAt && now() < closesAt;
    };

    return {
        resolveDayOfWeekText,
        resolveEstablishmentDay,
        isEstablishmentCurrentlyOpen,
    };
};
