import Image from 'next/image';
import Link from 'next/link';

const Card = ({
  url = '',
  alt,
  width = 100,
  height = 100,
  title,
  description,
}) => {
  return (
    <div className="Card shadow-md rounded-sm">
      <div className="Card-header">
        <div className="Card-header-image px-10">
          <Image
            layout="responsive"
            loading="lazy"
            src={url}
            alt={alt}
            width={width}
            height={height}
          />
        </div>
      </div>
      <div className="Card-body p-4">
        <h3 className={'mt-0'}>
          <Link href={'/'} className={'text-[1.6rem] text-style-7'}>
            {title}
          </Link>
        </h3>
        <p className={'font-[400]'}>{description}</p>
      </div>
    </div>
  );
};
export default Card;
