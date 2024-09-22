import { Col, Row } from 'antd';
import Image from 'next/image';
import { useRouter } from 'next/router';

import ImageCTA from '@/assets/images/image-cta.webp';
import { ETypeNotification } from '@/common/enums';
import ButtonComponent from '@/components/Button';
import Container from '@/containers/Container';
import { useAPI } from '@/contexts/APIContext';
import { Paths } from '@/routers/constants';
import { showNotification } from '@/utils/function';

const Cta = () => {
  const { isLogin } = useAPI();
  const router = useRouter();
  const onSubmitProfile = () => {
    if (!isLogin)
      return showNotification(
        ETypeNotification.INFO,
        'Bạn cần phải đăng nhập để nộp hồ sơ !'
      );
    router.push(`${Paths.Profile.SubmitProfileStep}`);
  };
  return (
    <section className={'lg:py-[7rem] py-[2rem]'}>
      <Container>
        <Row gutter={[24, 24]}>
          <Col span={24} md={{ span: 24 }} lg={{ span: 12 }}>
            <div className={'relative min-h-[27rem] p-[5rem_4rem] rounded-sm'}>
              <div className={'absolute w-full h-full top-0 left-0'}>
                <Image
                  quality={100}
                  src={ImageCTA}
                  alt={''}
                  loading={'lazy'}
                  width={649}
                  height={273}
                  className={
                    'w-full h-full object-cover object-left lg:object-center rounded-sm'
                  }
                />
              </div>
              <div className={'relative max-w-[31rem]'}>
                <span
                  className={'lg:text-button-16 text-body-14 text-style-10'}
                >
                  Chẳng cần agent
                </span>
                <p
                  className={
                    'my-4 lg:text-title-24 text-button-16 text-style-7'
                  }
                >
                  Tự mình chinh phục ngôi trường bạn mơ ước bằng cách Tự nộp hồ
                  sơ
                </p>
                <ButtonComponent
                  title={'Tự nộp hồ sơ'}
                  className={'primary w-[14.8rem] mt-[3.2rem] lg:mt-0'}
                  loading={false}
                  onClick={onSubmitProfile}
                />
              </div>
            </div>
          </Col>
          <Col span={24} md={{ span: 24 }} lg={{ span: 12 }}>
            <div className={'relative min-h-[27rem] p-[5rem_4rem] rounded-sm'}>
              <div className={'absolute w-full h-full top-0 left-0'}>
                <Image
                  src={ImageCTA}
                  alt={''}
                  quality={100}
                  loading={'lazy'}
                  width={649}
                  height={273}
                  className={
                    'w-full h-full object-cover object-left lg:object-center rounded-sm'
                  }
                />
              </div>
              <div className={'relative max-w-[31rem]'}>
                <span
                  className={'lg:text-button-16 text-body-14 text-style-10'}
                >
                  Đặt lịch ngay
                </span>
                <p
                  className={
                    'my-4 lg:text-title-24 text-button-16 text-style-7'
                  }
                >
                  Để được tư vấn và hỗ trợ chuẩn bị hồ sơ cùng các chuyên gia
                </p>
                <ButtonComponent
                  title={'Liên Hệ'}
                  className={'primary w-[14.8rem] mt-[3.2rem] lg:mt-0'}
                  loading={false}
                />
              </div>
            </div>
          </Col>
        </Row>
      </Container>
    </section>
  );
};
export default Cta;
