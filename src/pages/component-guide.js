import React from 'react';

import ButtonComponent from '@/components/Button';
import { EIconName } from '@/components/Icon/Icon.enum';
import {Typography} from "antd";

const ComponentGuide = () => {
  return (
    <>
      <div>
        <Typography.Title level={3}>Button Component</Typography.Title>
        <ButtonComponent title={'Đăng Ký'} className={'orange mt-3 ml-4'} />
        <ButtonComponent
          title={'Đăng Ký'}
          className={'primary mt-3 ml-4'}
          loading={false}
        />
        <ButtonComponent
          title={'Đăng Ký'}
          className={'primary-outline mt-3 ml-4'}
          loading={true}
        />
        <ButtonComponent
          title={'Đăng Ký'}
          className={'primary mt-3 ml-4'}
          secondIconName={EIconName.Arrow_Right}
        />
      </div>
      {/*<Row gutter={[24, 24]} className={'flex'}>*/}
      {/*  {data &&*/}
      {/*    data.map((element) => {*/}
      {/*      return (*/}
      {/*        <Col span={24} md={{ span: 6 }} key={element?.id}>*/}
      {/*          {loading ? LoadingSkeletonCards() : ''}*/}
      {/*          {!loading && (*/}
      {/*            <Card*/}
      {/*              url={'https://kingstudy.vn' + element?.logo}*/}
      {/*              title={element?.name}*/}
      {/*              description={element?.heading}*/}
      {/*              alt={element?.name}*/}
      {/*            />*/}
      {/*          )}*/}
      {/*        </Col>*/}
      {/*      );*/}
      {/*    })}*/}
      {/*  <Col span={24}>*/}
      {/*    <div className={'w-full flex items-center justify-center'}>*/}
      {/*      {' '}*/}
      {/*      <Button type={'primary'} onClick={onLoadMore}>*/}
      {/*        Load more*/}
      {/*      </Button>*/}
      {/*    </div>*/}
      {/*  </Col>*/}
      {/*</Row>*/}
    </>
  );
};
export default ComponentGuide;
