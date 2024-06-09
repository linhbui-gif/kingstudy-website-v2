import React, { useRef } from 'react';
const Upload = ({
  className = '',
  accept,
  multiple,
  children,
  disabled,
  onChange,
}) => {
  const inputFilesRef = useRef(null);

  const handleClickUpload = () => {
    if (!disabled) inputFilesRef?.current?.click();
  };

  const handleChangeUpload = (event) => {
    const { files } = event.target;
    onChange?.(files);

    if (inputFilesRef.current) inputFilesRef.current.value = '';
  };

  return (
    <div className={`${className} w-full h-full`}>
      <div className="cursor-pointer w-full h-full" onClick={handleClickUpload}>
        {children}
      </div>
      <input
        ref={inputFilesRef}
        className="hidden"
        accept={accept}
        type="file"
        multiple={multiple}
        onChange={handleChangeUpload}
      />
    </div>
  );
};

export default Upload;
