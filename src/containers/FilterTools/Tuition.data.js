export const ETuition = {
  ALL: '',
  UNLESS_500: 499000000,
  FROM_500_TO_1B: 600000000,
  THAN_1B: 1000000000,
};
export const dataTuitionOptions = [
  { value: ETuition.ALL, label: 'Tất cả' },
  { value: ETuition.UNLESS_500, label: 'Dưới 500 triệu' },
  { value: ETuition.FROM_500_TO_1B, label: 'Từ 500 triệu đến 1 tỉ' },
  { value: ETuition.THAN_1B, label: 'Trên 1 tỉ' },
];
