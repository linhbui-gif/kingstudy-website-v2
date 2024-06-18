import { useState } from 'react';

import { Flex, Space } from 'antd';
import { useRouter } from 'next/router';

import { ETypeNotification } from '@/common/enums';
import Arcodion from '@/components/Arcodion';
import ButtonComponent from '@/components/Button';
import Icon from '@/components/Icon';
import { EIconName } from '@/components/Icon/Icon.enum';
import Modal from '@/components/Modal';
import { useAPI } from '@/contexts/APIContext';
import { Paths } from '@/routers/constants';
import { submitProfileByCourse } from '@/services/profile';
import { showNotification } from '@/utils/function';
import { useModalState } from '@/utils/hook';
const CourseAccordion = ({ data, hasDocument, school_id }) => {
  const { isLogin } = useAPI();
  const router = useRouter();
  const [isModalVisible, handleOpen, handleClose] = useModalState();
  const [courseId, setCourseId] = useState(0);
  const [loading, setLoading] = useState(false);
  const [
    isModalVisibleNotDocument,
    handleOpenNotDocument,
    handleCloseNotDocument,
  ] = useModalState();

  const submitProfile = async () => {
    try {
      const params = {
        school_id: school_id,
        course_id: courseId,
      };
      setLoading(true);
      const response = await submitProfileByCourse(params);
      if (response?.status === 200) {
        setLoading(false);
        showNotification(ETypeNotification.SUCCESS, 'Nộp hồ sơ thành công !');
        handleCloseNotDocument();
      }
    } catch (e) {
      setLoading(false);
    }
  };
  const onSubmitProfile = (course_id) => {
    if (isLogin) {
      if (hasDocument) {
        setCourseId(course_id);
        handleOpenNotDocument();
      } else {
        handleOpen();
      }
    } else {
      showNotification(
        ETypeNotification.WARNING,
        'Bạn cần phải đăng nhập để nộp hồ sơ !'
      );
    }
  };
  const itemArr =
    data &&
    data.map((element) => {
      return {
        key: element?.id,
        label: element?.name,
        children: (
          <>
            <div
              dangerouslySetInnerHTML={{
                __html: element?.content,
              }}
            />
            <Space>
              <ButtonComponent
                title={'Nộp hồ sơ'}
                className={'primary mt-[2.4rem]'}
                onClick={() => onSubmitProfile(element?.id)}
              />
              <ButtonComponent
                title={'Xem chi tiết'}
                className={'default mt-[2.4rem]'}
                onClick={() => {
                  router.push(element?.link_course);
                }}
              />
            </Space>
          </>
        ),
      };
    });

  const customExpandIcon = ({ isActive }) => (
    <div>
      {isActive ? (
        <Icon name={EIconName.Minus} />
      ) : (
        <Icon name={EIconName.Plus} />
      )}
    </div>
  );

  return (
    <>
      {isModalVisible?.visible && (
        <Modal
          visible={isModalVisible?.visible}
          title={'Thông báo'}
          onClose={handleClose}
        >
          <p className="text-center">Bạn chưa có hồ sơ trước đó</p>
          <p className="text-center"> Vui lòng bấm tiếp tục để nộp hồ sơ !</p>
          <Flex gap={'small'} justify={'center'}>
            <ButtonComponent
              title={'Hủy'}
              className={'primary-outline w-[15rem]'}
              onClick={handleClose}
            />
            <ButtonComponent
              title={'Tiếp tục'}
              className={'primary w-[15rem]'}
              onClick={() => {
                router.push(`${Paths.Profile.SubmitProfileStep}`);
              }}
            />
          </Flex>
        </Modal>
      )}
      {isModalVisibleNotDocument?.visible && (
        <Modal
          visible={isModalVisibleNotDocument?.visible}
          title={'Thông báo'}
          onClose={handleCloseNotDocument}
        >
          <p className="text-center">Bạn đã có hồ sơ trước đó</p>
          <p className="text-center">
            {' '}
            Vui lòng nộp ngay ! Hoặc Có thể tạo hồ sơ mới
          </p>
          <Flex gap={'small'} justify={'center'}>
            <ButtonComponent
              title={'Tạo mới'}
              className={'primary-outline w-[15rem]'}
              onClick={handleCloseNotDocument}
            />
            <ButtonComponent
              title={'Nộp ngay'}
              className={'primary w-[15rem]'}
              onClick={submitProfile}
              loading={loading}
            />
          </Flex>
        </Modal>
      )}
      <Arcodion items={itemArr} expandIcon={customExpandIcon} />
    </>
  );
};
export default CourseAccordion;
