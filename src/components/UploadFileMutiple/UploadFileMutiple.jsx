import React, { useState } from 'react';

import { Upload } from 'antd';

import Icon from '@/components/Icon';
import { EIconName } from '@/components/Icon/Icon.enum';
import { getFileExtension } from '@/utils/function';

const UploadFileMutiple = ({
  className = '',
  classNameIcon = '',
  onChange,
}) => {
  const [fileLists, setFileList] = useState([]);

  const handleChange = ({ fileList: newFileList }) => {
    const formData = new FormData();
    newFileList &&
      newFileList.map((element) => {
        const originFileObj = element?.originFileObj;
        formData.append('files[]', originFileObj);
      });
    setFileList(newFileList);
    onChange?.(newFileList);
  };
  const uploadButton = (
    <div className={`${classNameIcon} flex justify-center`}>
      <Icon name={EIconName.Plus} />
    </div>
  );

  return (
    <div
      className={`Upload-multiple flex items-center gap-x-[8px] ${className}`}
    >
      <Upload
        action="#"
        listType="picture-card"
        fileList={fileLists}
        onChange={handleChange}
        multiple
        itemRender={(originNode, file, fileList, { remove }) => {
          const ext = file?.name ? getFileExtension(file?.name) : '';
          const icon = (
            <Icon
              className={'m'}
              name={ext === 'docx' ? EIconName.Words : EIconName.Pdf}
            />
          );
          return (
            <div className={'shadow-md rounded-sm'} key={file.uid}>
              <div
                className={
                  'flex items-center justify-center bg-style-10 rounded-sm min-h-[10rem]'
                }
              >
                {icon}
              </div>
              <div className={'p-[2rem_1rem]'}>
                <h5 className={'text-body-14 font-[500]'}>{file?.name}</h5>
                <span
                  className={'cursor-pointer text-red text-body-14'}
                  onClick={() => remove(file)}
                >
                  Delete
                </span>
              </div>
            </div>
          );
        }}
      >
        {uploadButton}
      </Upload>
    </div>
  );
};
export default UploadFileMutiple;
