import React, { useState } from 'react';

import { Col, Row } from 'antd';

import Icon from '@/components/Icon';
import { EIconColor } from '@/components/Icon/Icon.enum';
import Container from '@/containers/Container';
import { MajorData } from '@/containers/Major/Major.data';
const Major = () => {
  const [hoveredIndex, setHoveredIndex] = useState(null);

  const handleMouseEnter = (index) => {
    setHoveredIndex(index);
  };

  const handleMouseLeave = () => {
    setHoveredIndex(null);
  };
  return (
    <section className={'lg:py-[7rem] py-[2rem]'}>
      <Container>
        <Row gutter={[24, 24]}>
          <Col span={24}>
            <h2
              className={
                'lg:text-title-36 text-[2rem] font-[700] text-style-7 text-center'
              }
            >
              Các Ngành Học Nổi Bật
            </h2>
          </Col>
          {MajorData.map((major, index) => {
            const isHovered = hoveredIndex === index;
            return (
              <Col span={24} md={{ span: 12 }} lg={{ span: 8 }} key={major?.id}>
                <div
                  className={
                    'Major-item flex items-center gap-[2.4rem] p-[2.4rem_3.2rem] border border-solid border-style-8 rounded-sm transition group hover:bg-style-10 cursor-pointer'
                  }
                  onMouseEnter={() => handleMouseEnter(index)}
                  onMouseLeave={handleMouseLeave}
                >
                  <Icon
                    name={major.iconName}
                    color={!isHovered ? EIconColor.STYLE_10 : EIconColor.WHITE}
                  />
                  <span
                    className={
                      'lg:text-title-24 text-body-14 font-[600] text-style-7 group-hover:text-white'
                    }
                  >
                    {major.name}
                  </span>
                </div>
              </Col>
            );
          })}
        </Row>
      </Container>
    </section>
  );
};
export default Major;
