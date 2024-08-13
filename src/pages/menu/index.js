import { Col, Flex, Row } from 'antd';
import Image from 'next/image';
import { useRouter } from 'next/router';

import ImageAvatarDefault from '@/assets/images/image-avatar-default.png';
import { ETypeNotification } from '@/common/enums';
import ButtonComponent from '@/components/Button';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import Container from '@/containers/Container';
import GuestLayout from '@/layouts/GuestLayout';
import { ModulePaths, Paths } from '@/routers/constants';
import { showNotification } from '@/utils/function';

const Menu = () => {
  const router = useRouter();
  return (
    <div className={'min-h-screen mt-5 overflow-y-scroll pb-[3rem]'}>
      <Container>
        <Row gutter={[16, 16]}>
          <Col span={24}>
            <Flex
              align={'center'}
              className={'bg-white rounded-sm shadow p-5'}
              onClick={() => {
                showNotification(
                  ETypeNotification.WARNING,
                  'Bạn cần phải đăng nhập để sử dụng tính năng này !'
                );
              }}
            >
              <Image
                className={'w-[35px] h-[35px] rounded-full'}
                layout={'fix'}
                src={ImageAvatarDefault}
                alt={'avatar-default'}
              />
              <div className={'flex-1 pl-5'}>
                <p className={'mb-0 text-body-14 text-style-9'}>
                  Xem thông tin cá nhân
                </p>
              </div>
              <Icon
                className={'rotate-[-90deg]'}
                name={EIconName.ArowDown}
                color={EIconColor.STYLE_10}
              />
            </Flex>
          </Col>
          <Col span={24}>
            <div className={'bg-white rounded-sm shadow'}>
              <Flex
                align={'center'}
                className={'bg-white p-5'}
                onClick={() => router.push(`${Paths.About.View}`)}
              >
                <Icon name={EIconName.Information} />
                <span className={'text-body-16 text-style-7 pl-5 flex-1'}>
                  Giới thiệu
                </span>
                <Icon
                  className={'rotate-[-90deg]'}
                  name={EIconName.ArowDown}
                  color={EIconColor.STYLE_10}
                />
              </Flex>
              <Flex
                align={'center'}
                className={'bg-white p-5'}
                onClick={() => router.push(`${Paths.Blog.View}`)}
              >
                <Icon name={EIconName.Information} />
                <span className={'text-body-16 text-style-7 pl-5 flex-1'}>
                  Tin tức
                </span>
                <Icon
                  className={'rotate-[-90deg]'}
                  name={EIconName.ArowDown}
                  color={EIconColor.STYLE_10}
                />
              </Flex>
            </div>
          </Col>
          <Col span={24}>
            <div className={'bg-white rounded-sm shadow'}>
              <Flex
                align={'center'}
                className={'bg-white p-5'}
                onClick={() => {
                  router.push(`${Paths.School.View}?country_id=7`);
                }}
              >
                <Icon name={EIconName.Plane} />
                <span className={'text-body-16 text-style-7 pl-5 flex-1'}>
                  Du học anh
                </span>
                <Icon
                  className={'rotate-[-90deg]'}
                  name={EIconName.ArowDown}
                  color={EIconColor.STYLE_10}
                />
              </Flex>
              <Flex
                align={'center'}
                className={'bg-white p-5'}
                onClick={() => {
                  router.push(`${Paths.School.View}?country_id=8`);
                }}
              >
                <Icon name={EIconName.Plane} />
                <span className={'text-body-16 text-style-7 pl-5 flex-1'}>
                  Du học úc
                </span>
                <Icon
                  className={'rotate-[-90deg]'}
                  name={EIconName.ArowDown}
                  color={EIconColor.STYLE_10}
                />
              </Flex>
              <Flex
                align={'center'}
                className={'bg-white p-5'}
                onClick={() => {
                  router.push(`${Paths.School.View}?country_id=9`);
                }}
              >
                <Icon name={EIconName.Plane} />
                <span className={'text-body-16 text-style-7 pl-5 flex-1'}>
                  Du học Canada
                </span>
                <Icon
                  className={'rotate-[-90deg]'}
                  name={EIconName.ArowDown}
                  color={EIconColor.STYLE_10}
                />
              </Flex>
              <Flex
                align={'center'}
                className={'bg-white p-5'}
                onClick={() => {
                  router.push(`${Paths.School.View}?country_id=5`);
                }}
              >
                <Icon name={EIconName.Plane} />
                <span className={'text-body-16 text-style-7 pl-5 flex-1'}>
                  Du học Mỹ
                </span>
                <Icon
                  className={'rotate-[-90deg]'}
                  name={EIconName.ArowDown}
                  color={EIconColor.STYLE_10}
                />
              </Flex>
              <Flex
                align={'center'}
                className={'bg-white p-5'}
                onClick={() => {
                  router.push(`${Paths.School.View}?country_id=11`);
                }}
              >
                <Icon name={EIconName.Plane} />
                <span className={'text-body-16 text-style-7 pl-5 flex-1'}>
                  Du học Ireland
                </span>
                <Icon
                  className={'rotate-[-90deg]'}
                  name={EIconName.ArowDown}
                  color={EIconColor.STYLE_10}
                />
              </Flex>
              <Flex
                align={'center'}
                className={'bg-white p-5'}
                onClick={() => {
                  router.push(`${Paths.School.View}?country_id=10`);
                }}
              >
                <Icon name={EIconName.Plane} />
                <span className={'text-body-16 text-style-7 pl-5 flex-1'}>
                  Du học Hà Lan
                </span>
                <Icon
                  className={'rotate-[-90deg]'}
                  name={EIconName.ArowDown}
                  color={EIconColor.STYLE_10}
                />
              </Flex>
            </div>
          </Col>
          <Col span={24}>
            <div className={'bg-white rounded-sm shadow'}>
              <Flex
                align={'center'}
                className={'bg-white p-5'}
                onClick={() => router.push(`${Paths.Survey.View}`)}
              >
                <Icon name={EIconName.Setting} />
                <span className={'text-body-16 text-style-7 pl-5 flex-1'}>
                  Khảo sát
                </span>
                <Icon
                  className={'rotate-[-90deg]'}
                  name={EIconName.ArowDown}
                  color={EIconColor.STYLE_10}
                />
              </Flex>
            </div>
          </Col>
          <Col span={24}>
            <div className={'bg-white rounded-sm shadow'}>
              <Flex align={'center'} className={'bg-white p-5'}>
                <Icon name={EIconName.Account} />
                <span className={'text-body-16 text-style-7 pl-5 flex-1'}>
                  Liên Hệ
                </span>
                <Icon
                  className={'rotate-[-90deg]'}
                  name={EIconName.ArowDown}
                  color={EIconColor.STYLE_10}
                />
              </Flex>
            </div>
          </Col>
          <Col span={24}>
            <ButtonComponent
              link={`${ModulePaths.Auth}${Paths.Login}`}
              className={'primary w-full'}
              title={'Đăng nhập'}
            />
          </Col>
        </Row>
      </Container>
    </div>
  );
};
export default Menu;
Menu.getLayout = function (page) {
  return (
    <>
      <GuestLayout>{page}</GuestLayout>
    </>
  );
};
