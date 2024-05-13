import { Col, Row } from 'antd';
import Image from 'next/image';

import ImageAbout from '@/assets/images/image-about.webp';
import ButtonComponent from '@/components/Button';
import Container from '@/containers/Container';
const About = () => {
  return (
    <section className={'lg:py-[7rem] py-[2rem]'}>
      <Container>
        <Row gutter={[24, 24]}>
          <Col lg={{ span: 12, order: 1 }} span={24} order={2}>
            <h3
              className={
                'lg:text-title-36 text-[2rem] font-[700] text-style-7 lg:mb-[7rem] mb-[1.8rem]'
              }
            >
              Chào Mừng Tới KingStudy
            </h3>
            <div className={'text-body-16 text-style-12 lg:max-w-[50rem]'}>
              <p>
                Với mô hình ONE - STOP - STATION (một trạm), KingStudy cung cấp
                đa dạng các dịch vụ nhằm giúp các bạn học sinh rút ngắn được
                thời gian để chạm tới giấc mơ du học mà không phải tìm đến bất
                kỳ đơn vị nào khác để hỗ trợ. KingStudy tự hào là người bạn đồng
                hành giúp đỡ sinh viên Việt Nam thực hiện hoá giấc mơ du học.
              </p>
              <ul>
                <li className={'list-disc mb-[2rem]'}>
                  {' '}
                  10 năm kinh nghiệm tư vấn du học
                </li>

                <li className={'list-disc mb-[2rem]'}>Tỉ lệ visa đạt 100%</li>

                <li className={'list-disc'}>
                  {' '}
                  Làm việc chuyên nghiệp, uy tín, có lộ trình rõ ràng
                </li>
              </ul>
              <ButtonComponent
                title={'Tìm hiểu thêm'}
                className={'primary-outline mt-[4rem]'}
                loading={false}
              />
            </div>
          </Col>
          <Col lg={{ span: 12, order: 2 }} span={24} order={1}>
            <Image
              src={ImageAbout}
              alt={'about'}
              layout={'responsive'}
              loading={'lazy'}
            />
          </Col>
        </Row>
      </Container>
    </section>
  );
};
export default About;
