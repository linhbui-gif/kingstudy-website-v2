'use client';

const TagTimeStartLearn = ({ value, onChange, options = [] }) => {
  const renderTagItems = options.map((item) => {
    return (
      <div className={`min-w-[25rem] md:min-w-auto`} key={item.id}>
        <div
          className={`border border-solid border-style-8 cursor-pointer text-body-16 py-[1rem] px-[1.5rem] rounded-sm ${
            value && value.value === item.value
              ? 'text-white font-bold bg-style-10'
              : 'text-style-9'
          }`}
          onClick={() => {
            onChange?.(item);
          }}
        >
          {item.label}
        </div>
      </div>
    );
  });
  return (
    <div
      className={`Tags flex items-center md:flex-wrap gap-[1rem] overflow-x-scroll md:overflow-auto`}
    >
      {renderTagItems}
    </div>
  );
};

export default TagTimeStartLearn;
