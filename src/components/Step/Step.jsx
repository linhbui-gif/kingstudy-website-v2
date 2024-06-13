import React, { useEffect } from "react";


const Steps = ({
  options = [],
  value,
  onChange,
  lineWidth,
  registerStore = true,
  className = "",
  title,
}) => {
  const passIndexStep = options.findIndex((option) => option.id === value?.id);
  const activeStep = options.find((option) => option.id === value?.id);

  useEffect(() => {
    if (!value) onChange?.(options?.[0]);
  }, [value, onChange, options]);
  
  return (
    <div className={`Steps ${className}`}>
      {registerStore && (
        <div className="text-[18px] font-[600] text-black leading-normal mb-[12px]">
          {title}
        </div>
      )}
      {registerStore && (
        <div className="Steps-step flex items-center justify-between">
          {options.map((item, index) => (
            <div
              key={item.id}
              className={`Steps-step-item-line ${
                index <= passIndexStep ? "active" : ""
              }`}
              style={{
                flex: `0 0 ${lineWidth || `calc(100% / ${options.length})`}`,
                width: `${lineWidth || `calc(100% / ${options.length})`}`,
                maxWidth: `${lineWidth || `calc(100% / ${options.length})`}`,
              }}
            />
          ))}
        </div>
      )}
      {activeStep && (
        <div className={`Steps-children ${className}`}>
          {activeStep.children}
        </div>
      )}
    </div>
  );
};

export default Steps;
