import Image from 'next/image';

const Card = ({
  url = '',
  alt,
  width = 100,
  height = 100,
  title,
  description,
}) => {
  return (
    <div className="Card">
      <div className="Card-header">
        <div className="Card-header-image">
          <Image src={url} alt={alt} width={width} height={height} />
        </div>
      </div>
      <div className="Card-body">
        <h3 className="Card-body-title">{title}</h3>
        <p>{description}</p>
      </div>
    </div>
  );
};
export default Card;
