import { useEffect, useState } from 'react';

export const useDebounce = (value, delay) => {
  const [debouncedValue, setDebouncedValue] = useState(value);

  useEffect(() => {
    const handleDebounce = setTimeout(() => {
      setDebouncedValue(value);
    }, delay);

    return () => {
      clearTimeout(handleDebounce);
    };
  }, [value, delay]);

  return debouncedValue;
};

export const useModalState = () => {
  const [modalState, setModalState] = useState({ visible: false });

  const handleOpenModal = (data, dataKey) => {
    setModalState({ ...dataKey, visible: true, data });
  };

  const handleCloseModal = () => {
    setModalState({ visible: false });
  };

  return [modalState, handleOpenModal, handleCloseModal];
};
