'use client';
import TagCountry from '@/components/Tag/TagCountry';
import TagFilter from '@/components/Tag/TagFilter';

const Tag = ({
  value,
  onChange,
  options = [],
  className,
  filterTool = false,
}) => {
  const renderTagItems = options.map((item) => {
    return (
      <div
        className={`${!filterTool ? 'pr-[2.8rem] last:pr-0' : ''}`}
        key={item.id}
      >
        {!filterTool ? (
          <TagCountry value={value} onChange={onChange} item={item} />
        ) : (
          <TagFilter value={value} onChange={onChange} item={item} />
        )}
      </div>
    );
  });
  return (
    <div
      className={`${
        filterTool
          ? 'flex items-center flex-wrap gap-[1rem] px-[1.6rem]'
          : 'Tags flex items-center overflow-x-scroll md:overflow-x-visible mt-[28px]'
      } ${className} `}
    >
      {renderTagItems}
    </div>
  );
};

export default Tag;
