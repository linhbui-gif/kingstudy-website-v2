import React from 'react';

import Container from '@/containers/Container';
const Vison = ({ title, description }) => {
  return (
    <div className={'py-[9rem] bg-style-13'}>
      <Container>
        <h2
          className={
            'lg:text-title-36 text-[2rem] font-[700] text-style-7 mb-[3rem] text-center'
          }
        >
          {title || ''}
        </h2>
        <div
          dangerouslySetInnerHTML={{
            __html: description,
          }}
          className={'description-vision'}
        />
      </Container>
    </div>
  );
};
export default Vison;
