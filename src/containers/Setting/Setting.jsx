import { Col, Flex, Row } from 'antd';
import { useRouter } from 'next/router';

import ImageAvatarDefault from '@/assets/images/image-avatar-default.png';
import { EProfileSidebar, ETypeNotification } from '@/common/enums';
import Avatar from '@/components/Avatar';
import ButtonComponent from '@/components/Button';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import Container from '@/containers/Container';
import { Paths } from '@/routers/constants';
import Helpers from '@/services/helpers';
import { showNotification } from '@/utils/function';
import { rootUrl } from '@/utils/utils';

const Setting = ({ userInformation, setSwitchUIMobile }) => {
  const router = useRouter();
  const handleLogout = () => {
    Helpers.clearTokens();
    router.push(`${Paths.Home}`);
    showNotification(
      ETypeNotification.SUCCESS,
      'Đăng xuất tài khoản thành công !'
    );
  };
  return (
    <div className={'min-h-screen mt-5 overflow-y-scroll'}>
      <Container>
        <Row gutter={[16, 16]}>
          <Col span={24}>
            <Flex
              align={'center'}
              className={'bg-white rounded-sm shadow p-5'}
              onClick={() =>
                setSwitchUIMobile({
                  type: EProfileSidebar.MY_PROFILE_INFORMATION,
                })
              }
            >
              <Avatar
                image={
                  userInformation
                    ? `${rootUrl}${userInformation?.image_url}`
                    : ImageAvatarDefault
                }
              />
              <div className={'flex-1 pl-5'}>
                <h3> {userInformation?.full_name}</h3>
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
                onClick={() =>
                  setSwitchUIMobile({ type: EProfileSidebar.SETTING })
                }
              >
                <Icon name={EIconName.Account} />
                <span className={'text-body-16 text-style-7 pl-5 flex-1'}>
                  Cài đặt
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
                <Icon name={EIconName.Account} />
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
                onClick={() =>
                  setSwitchUIMobile({ type: EProfileSidebar.INFORMATION_STUDY })
                }
              >
                <Icon name={EIconName.Account} />
                <span className={'text-body-16 text-style-7 pl-5 flex-1'}>
                  Thông tin du học
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
                onClick={() =>
                  setSwitchUIMobile({
                    type: EProfileSidebar.TRACKING_PROFILE_INFORMATION,
                  })
                }
              >
                <Icon name={EIconName.Account} />
                <span className={'text-body-16 text-style-7 pl-5 flex-1'}>
                  Theo dõi hồ sơ
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
                onClick={() =>
                  setSwitchUIMobile({
                    type: EProfileSidebar.MANAGER_PROFILE_INFORMATION,
                  })
                }
              >
                <Icon name={EIconName.Account} />
                <span className={'text-body-16 text-style-7 pl-5 flex-1'}>
                  Quản lý hồ sơ
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
                onClick={() =>
                  setSwitchUIMobile({
                    type: EProfileSidebar.SCHOOL_FAVORITE,
                  })
                }
              >
                <Icon name={EIconName.Account} />
                <span className={'text-body-16 text-style-7 pl-5 flex-1'}>
                  Trường yêu thích
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
              className={'primary w-full'}
              title={'Đăng xuất'}
              onClick={handleLogout}
            />
          </Col>
        </Row>
      </Container>
    </div>
  );
};
export default Setting;
