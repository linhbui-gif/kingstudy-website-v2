import { Col, Flex, Row } from 'antd';
import { useRouter } from 'next/router';

import { ETypeNotification } from '@/common/enums';
import Avatar from '@/components/Avatar';
import ButtonComponent from '@/components/Button';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import Container from '@/containers/Container';
import { Paths } from '@/routers/constants';
import Helpers from '@/services/helpers';
import { showNotification } from '@/utils/function';

const Setting = () => {
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
            <Flex align={'center'} className={'bg-white rounded-sm shadow p-5'}>
              <Avatar />
              <div className={'flex-1 pl-5'}>
                <h3>BUI QUANG LINH</h3>
                <p className={'mb-0 text-body-14 text-style-9'}>
                  Thay đổi thông tin cá nhân
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
              <Flex align={'center'} className={'bg-white p-5'}>
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
              <Flex align={'center'} className={'bg-white p-5'}>
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
                  Dịch vụ
                </span>
                <Icon
                  className={'rotate-[-90deg]'}
                  name={EIconName.ArowDown}
                  color={EIconColor.STYLE_10}
                />
              </Flex>
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
              <Flex align={'center'} className={'bg-white p-5'}>
                <Icon name={EIconName.Account} />
                <span className={'text-body-16 text-style-7 pl-5 flex-1'}>
                  Blog Du Học
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
                  Dịch vụ
                </span>
                <Icon
                  className={'rotate-[-90deg]'}
                  name={EIconName.ArowDown}
                  color={EIconColor.STYLE_10}
                />
              </Flex>
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
              <Flex align={'center'} className={'bg-white p-5'}>
                <Icon name={EIconName.Account} />
                <span className={'text-body-16 text-style-7 pl-5 flex-1'}>
                  Blog Du Học
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
